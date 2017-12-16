<?php
namespace app\admin\controller;
class ProgramaArticle extends Base
{
    public $db;
    public $pdb;
    public $id;
    public $pid;
    public $type;
    /**
     * 构造方法
     */
    public function _auto()
    {
      $this->db = db('programa_article');
      $this->pdb = db('programa');
      $this->id = input('?get.id') ? input('get.id') : 0;
      $this->pid = input('?get.pid') ? input('get.pid') : 0;
      $this->type = input('?get.type') ? input('get.type') : 0;
      $this->assign('id',$this->id);
      $this->assign('pid',$this->pid);
      $this->assign('type',$this->type);
      $this->assign('active','Programa');
    }

    /**
     * 添加文章页面
     */
    public function add()
    {
        $this->assign('action','Programa/add');
        // Get
        if ($this->request->isGet())
        {
            // 读取父级栏目名称
            $data['pData']['cname'] = $this->pdb->where('id',$this->pid)->value('cname');
            // id
            if ($this->id)
            {
              $data['sData'] = $this->db->where('id',$this->id)->find();
            }
            else
            {
              $data['sData'] = '';
            }
            // assign
            $this->assign('data',$data);
            // 渲染模板输出
            return $this->fetch('add');
        }
        // Ajax
        if ($this->request->isAjax())
        {
            // title，content
            $title = input('?post.title') ? input('post.title') : '';
            $content = input('?post.content') ? input('post.content') : '';
            if ($title == false || $content == false)
            {
              return ajaxReturn(Rs(2,'文章标题或者文章内容不能为空！',''));
            }
            // 防止重复添加
            if ($this->db->where('title',$title)->count() && $this->id)
            {
              return ajaxReturn(Rs(3,'文章标题已经存在，请勿重复发布！',''));
            }
            // data
            $data = $this->getData();
            // id
            if ($this->id)
            {
                // 改
                $result = $this->db->where('id',$this->id)->update($data);
            }
            else
            {
                // 增
                $result = $this->db->insert($data);
            }
            // if
            if ($result)
            {
                return ajaxReturn(Rs(0,'受影响的操作！',''));
            }
            else
            {
                return ajaxReturn(Rs(1,'不受影响的操作！',''));
            }
        }
    }

    /**
     * 初始化数据
     */
    private function getData()
    {
        if ($this->id)
        {
          $data['title'] = input('post.title');
          $data['tips'] = input('post.tips');
          $data['search_keywords'] = input('post.search_keywords');
          $data['content'] = input('post.content');
        }
        else
        {
          $data['title'] = input('post.title');
          $data['tips'] = input('post.tips');
          $data['search_keywords'] = input('post.search_keywords');
          $data['content'] = input('post.content');
          $data['auid'] = session('adminUser.id');
          $data['pid'] = $this->pid;
          $data['cover_path'] = '';
          $data['atype'] = 0;
          $data['status'] = 1;
          $data['ctime'] = time();
          $data['type'] = $this->type;
        }
        return $data;
    }

    /**
     * 文章列表
     */
    public function index()
    {
        $this->assign('action','Programa/index');
        // 读取栏目名称
        $data['pData']['cname'] = $this->pdb->where('id',$this->pid)->value('cname');
        // search
        $title = "%%";
        if (input('?post.search')) $title = "%".input('post.search')."%";
        // 根据父级id读取文章
        $data['sData'] = $this->db->where('pid',$this->pid)->where('title','like',$title)->order('ctime desc')->paginate(config('paging'),false,['query' => request()->param()]);
        // assign
        $this->assign('data',$data);
        // 渲染模板输出
        return $this->fetch('index');
    }

    /**
     * 删除
     */
    public function del()
    {
      // Ajax
      if ($this->request->isAjax())
      {
        // id
        $cover_path = $this->db->where('id',$this->id)->value('cover_path');
        if ($cover_path)
        {
            // 删除当前图片
            @unlink(ROOT_PATH . 'public' . $cover_path);
        }
        $result = $this->db->where('id',$this->id)->delete();
        if ($result)
        {
            return ajaxReturn(Rs(0,'受影响的操作！',''));
        }
        else
        {
            return ajaxReturn(Rs(1,'不受影响的操作！',''));
        }
      }
    }

    /**
     * 置顶
     */
    public function tops()
    {
      // Ajax
      if ($this->request->isAjax())
      {
        $data['atype'] = input('get.atype');
        $data['ctime'] = time();
        $result = $this->db->where('id',$this->id)->update($data);
        if ($result)
        {
            return ajaxReturn(Rs(0,'受影响的操作！',''));
        }
        else
        {
            return ajaxReturn(Rs(1,'不受影响的操作！',''));
        }
      }
    }

    /**
     * 展示
     */
    public function show()
    {
      // Ajax
      if ($this->request->isAjax())
      {
        $data['status'] = input('get.status');
        $data['ctime'] = time();
        $result = $this->db->where('id',$this->id)->update($data);
        if ($result)
        {
            return ajaxReturn(Rs(0,'受影响的操作！',''));
        }
        else
        {
            return ajaxReturn(Rs(1,'不受影响的操作！',''));
        }
      }
    }


    /**
     * coverUpload
     */
    public function coverUpload()
    {
      // Ajax
      if ($this->request->isAjax())
      {
        // id
        if ($this->id)
        {
            $cover_path = $this->db->where('id',$this->id)->value('cover_path');
            if ($cover_path)
            {
                // 删除当前图片
                @unlink(ROOT_PATH . 'public' . $cover_path);
            }
        }
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 更新数据
                $data['cover_path'] = DS . 'static' . DS . 'uploads' . DS . $info->getSaveName();
                $data['ctime'] = time();
                $this->db->where('id',$this->id)->update($data);
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                return ajaxReturn($info->getSaveName());
            }else{
                // 上传失败获取错误信息
                return ajaxReturn($file->getError());
            }
        }
      }
    }

    /**
     * 删除图片
     */
    public function coverDelete()
    {
      // 删除当前图片
      $path = ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads' . DS . input('post.path');
      @unlink($path);
      return ajaxReturn($path);
    }




}
