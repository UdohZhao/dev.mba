<?php
namespace app\admin\controller;
class Blogroll extends Base
{
    public $db;
    public $id;
    public $type;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->db = db('blogroll');
        $this->id = input('?get.id') ? input('get.id') : 0;
        $this->type = input('?get.type') ? input('get.type') : 0;
        $this->assign('id',$this->id);
        $this->assign('type',$this->type);

        // 控制器
        $this->assign('ctl','Blogroll');

        // type·1表示顶部栏目管理
        if ($this->type == 1)
        {
            $this->assign('ctlName','顶部栏目管理');
            $this->assign('active','topBlogroll');
        }
        else
        {
            $this->assign('ctlName','友情链接管理');
            $this->assign('active','Blogroll');
        }
    }

    /**
     * 添加banner页面
     */
    public function add()
    {
        // type·1表示顶部栏目管理
        if ($this->type == 1)
        {
            $this->assign('action','topBlogroll/add');
        }
        else
        {
            $this->assign('action','Blogroll/add');
        }
        // Get
        if ($this->request->isGet())
        {
            // id
            if ($this->id)
            {
                // 查
                $data = $this->db->where('id',$this->id)->find();
            }
            else
            {
                $data = '';
            }
            // assign
            $this->assign('data',$data);
            // 渲染模板输出
            return $this->fetch('add');
        }
        // Ajax
        if ($this->request->isAjax())
        {
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
        // data
        $data['cname'] = input('post.cname');
        $data['cname_link'] = input('post.cname_link');
        $data['status'] = 0;
        $data['type'] = $this->type;
        $data['ctime'] = time();
        return $data;
    }

    /**
     * banner列表页面
     */
    public function index()
    {
        // type·1表示顶部栏目管理
        if ($this->type == 1)
        {
            $this->assign('action','topBlogroll/index');
        }
        else
        {
            $this->assign('action','Blogroll/index');
        }
        // search
        $cname = "%%";
        if (input('?post.search')) $cname = "%".input('post.search')."%";
        // 根据父级id读取文章
        $data = $this->db->where('type',$this->type)->where('cname','like',$cname)->order('ctime desc')->paginate(config('paging'),false,['query' => request()->param()]);
        // assign
        $this->assign('data',$data);
        // 渲染模板输出
        return $this->fetch('index');
    }

    /**
     * 展示&隐藏
     */
    public function show()
    {
        // Ajax
        if ($this->request->isAjax())
        {
            $data['status'] = input('get.status');
            $data['ctime'] = time();
            $result = $this->db->where('id',$this->id)->update($data);
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
     * 删除
     */
    public function del()
    {
        // Ajax
        if ($this->request->isAjax())
        {
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


}
