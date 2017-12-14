<?php
namespace app\admin\controller;
class AdminUser extends Base
{
    public $db;
    public $id;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->db = model('AdminUser');
        $this->id = input('?get.id') ? input('get.id') : 0;
        $this->assign('id',$this->id);
        $this->assign('active','AdminUser');
    }

    /**
     * 添加用户页面
     */
    public function add()
    {
        $this->assign('action','AdminUser/add');
        // Get
        if ($this->request->isGet())
        {
            // id
            if ($this->id)
            {
                // 读取数据
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
            // 获取数据
            $data = $this->getData();
            // id
            if ($this->id)
            {
                // 改
                $res = $this->db->updates($this->id,$data);
            }
            else
            {
                // 增
                $res = $this->db->inserts($data);
            }
            // if
            if ($res)
            {
                return ajaxReturn(Rs(0,'提交成功！',''));
            }
            else
            {
                return ajaxReturn(Rs(1,'提交失败！',''));
            }
        }
    }

    /**
     * 初始化数据
     */
    private function getData()
    {
        // data
        $data['username'] = input('post.username');
        $data['password'] = enPassword(input('post.password'));
        $data['type'] = input('post.type');
        $data['status'] = input('post.status');
        $data['ctime'] = time();
        return $data;
    }

    /**
     * 检测用户名是否存在
     */
    public function checkUsername()
    {
        // Ajax
        if ($this->request->isAjax())
        {
            // 读取相同用户名
            if ($this->id)
            {
                return ['valid'=>true];
            }
            $username = input('post.username');
            $res = $this->db->where('username', $username)->find();
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
     * 用户列表页面
     */
    public function index()
    {
        $this->assign('action','AdminUser/index');
        // search
        $username = "%%";
        if (input('?post.search')) $username = "%".input('post.search')."%";
        // data
        $data = $this->db->where('username','like',$username)->paginate(config('paging'));
        // assign
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
            // 删除数据
            $res = $this->db->where('id',$this->id)->delete();
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
