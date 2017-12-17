<?php
namespace app\admin\controller;
class Blogroll extends Base
{
    public $db;
    public $id;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->db = db('blogroll');
        $this->id = input('?get.id') ? input('get.id') : 0;
        $this->assign('id',$this->id);
        // 控制器
        $this->assign('ctl','Blogroll');
        $this->assign('ctlName','友情链接管理');
        $this->assign('active','Blogroll');
    }

    /**
     * 添加banner页面
     */
    public function add()
    {
        $this->assign('action','Blogroll/add');
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
        $data['ctime'] = time();
        return $data;
    }

    /**
     * banner列表页面
     */
    public function index()
    {
        $this->assign('action','Blogroll/index');
        // search
        $cname = "%%";
        if (input('?post.search')) $cname = "%".input('post.search')."%";
        // 根据父级id读取文章
        $data = $this->db->where('cname','like',$cname)->order('ctime desc')->paginate(config('paging'),false,['query' => request()->param()]);
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
