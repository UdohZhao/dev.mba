<?php
namespace app\admin\controller;
class Programa extends Base
{
    public $db;
    public $id;
    public $pid;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->db = db('programa');
        $this->id = input('?get.id') ? input('get.id') : 0;
        $this->pid = input('?get.pid') ? input('get.pid') : 0;
        $this->assign('id',$this->id);
        $this->assign('pid',$this->pid);
        $this->assign('active','Programa');
    }

    /**
     * 添加栏目页面
     */
    public function add()
    {
        $this->assign('action','Programa/add');
        // Get
        if ($this->request->isGet())
        {
            // id
            if ($this->id && $this->pid)
            {
                // 查 父级
                $data = $this->db->where('id',$this->pid)->find();
                // 查 子级
                $data['son'] = $this->db->where('id',$this->id)->find();
            }
            else if ($this->id)
            {
                // 查
                $data = $this->db->where('id',$this->id)->find();
            }
            else if ($this->pid)
            {
                // 查
                $data = $this->db->where('id',$this->pid)->find();
            }
            else
            {
                $data = false;
            }
            // assign
            $this->assign('data',$data);
            // 渲染模板输出
            return $this->fetch('add');
        }
        // Ajax
        if ($this->request->isAjax())
        {
            // 获取数据初始化
            $data = $this->getData();
            // id
            if ($this->id)
            {
                // 改
                $res = $this->db->where('id',$this->id)->update($data);
            }
            else
            {
                // 增
                $res = $this->db->insert($data);
            }
            // if
            if ($res)
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
        $data['pid'] = $this->pid;
        $data['cname'] = input('post.cname');
        $data['ctime'] = time();
        $data['type'] = input('post.type');
        return $data;
    }

    /**
     * 检测栏目名称是否重复
     */
    public function checkCname()
    {
        // Ajax
        if ($this->request->isAjax())
        {
            // id 如果是更新数据就不验证是否重名
            if ($this->id)
            {
                return ['valid'=>true];
            }
            // pid
            if ($this->pid)
            {
                $res = $this->db->where('cname',input('post.cname'))->where('pid',$this->pid)->find();
            }
            else
            {
                $res = $this->db->where('cname',input('post.cname'))->find();
            }
            if ($res)
            {
                return ['valid'=>false];
            }
            else
            {
                return ['valid'=>true];
            }
        }
    }

    /**
     * 栏目列表
     */
    public function index()
    {
        $this->assign('action','Programa/index');
        // search
        $cname = "%%";
        if (input('?post.search')) $cname = "%".input('post.search')."%";
        // 查
        $data['programaData'] = $this->db->where('pid',$this->pid)->where('cname','like',$cname)->paginate(config('paging'),false,['query' => request()->param()]);
        // assign 用户权限
        $data['permissionsData'] = session('adminUser.permissions');
        $this->assign('data',$data);
        // 渲染模板输出
        return $this->fetch('index');
    }

    /**
     * 删除数据
     */
    public function del()
    {
        // Ajax
        if ($this->request->isAjax())
        {
            // 删，查询是否有子级
            $count = $this->db->where('pid',$this->id)->count('id');
            // if
            if ($count)
            {
                return ajaxReturn(Rs(2,'请先删除该栏目子级',''));
            }
            // 执行删除
            $res = $this->db->where('id',$this->id)->delete();
            // if
            if ($res)
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
