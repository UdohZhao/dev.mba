<?php
namespace app\admin\controller;
class AdAcademy extends Base
{
    public $db;
    public $id;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->db = db('ad_academy');
        $this->id = input('?get.id') ? input('get.id') : 0;
        $this->assign('id',$this->id);
        // 控制器
        $this->assign('ctl','AdAcademy');
        $this->assign('ctlName','院校推荐广告管理');
        $this->assign('active','AdAcademy');
    }

    /**
     * 添加banner页面
     */
    public function add()
    {
        $this->assign('action','AdAcademy/add');
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
            return $this->fetch('banner/add');
        }
        // Ajax
        if ($this->request->isAjax())
        {
            // data
            $data = $this->getData();
            // if
            if ($data['img_path'] == '')
            {
                return ajaxReturn(Rs(2,'请上传banner！',''));
            }
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
        $data['img_path'] = input('post.img_path');
        $data['img_link'] = input('post.img_link');
        $data['status'] = 0;
        $data['ctime'] = time();
        return $data;
    }

    /**
     * banner列表页面
     */
    public function index()
    {
        $this->assign('action','AdAcademy/index');
        // search
        $img_link = "%%";
        if (input('?post.search')) $img_link = "%".input('post.search')."%";
        // 根据父级id读取文章
        $data = $this->db->where('img_link','like',$img_link)->order('ctime desc')->paginate(config('paging'),false,['query' => request()->param()]);
        // assign
        $this->assign('data',$data);
        // 渲染模板输出
        return $this->fetch('banner/index');
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
     * 删除图片
     */
    public function delImg()
    {
        // Ajax
        if ($this->request->isAjax())
        {
            $data['img_path'] = '';
            $data['ctime'] = time();
            $result = $this->db->where('id',$this->id)->update($data);
            if ($result)
            {
                // 删除当前图片
                $path = ROOT_PATH . 'public' . input('post.img_path');
                @unlink($path);
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
                // 删除当前图片
                $path = ROOT_PATH . 'public' . input('post.img_path');
                @unlink($path);
                return ajaxReturn(Rs(0,'受影响的操作！',''));
            }
            else
            {
                return ajaxReturn(Rs(1,'不受影响的操作！',''));
            }
        }
    }


}
