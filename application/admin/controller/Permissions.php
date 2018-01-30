<?php
namespace app\admin\controller;
class Permissions extends Base
{
    public $db;
    public $auid;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->db = db('permissions');
        $this->auid = input('?get.auid') ? input('get.auid') : 0;
        $this->assign('auid',$this->auid);
        $this->assign('active','Permissions');
    }

    /**
     * 配置权限页面
     */
    public function add()
    {
        $this->assign('action','Programa/add');
        // Get
        if ($this->request->isGet())
        {
            // 读取用户用户名
            $data['username'] = db('admin_user')->where('id',$this->auid)->value('username');
            // 读取栏目
            $data['programaData'] = db('programa')->select();
            // 读取当前用户权限
            $data['permissionsData'] = $this->db->where('auid',$this->auid)->find();
            if ($data['permissionsData'])
            {
                $data['permissionsData']['pid'] = unserialize($data['permissionsData']['pid']);
            }
            // assign
            $this->assign('data',$data);
            // 渲染模板输出
            return $this->fetch('add');
        }
        // Ajax
        if ($this->request->isAjax())
        {
            // if 栏目id不能为空
            if (input('post.pid/a') == null)
            {
                return ajaxReturn(Rs(2,'请选择需要赋值权限的栏目！',''));
            }
            // data
            $data = $this->getData();
            // 查
            if ($this->db->where('auid',$this->auid)->count())
            {
                // 改
                $result = $this->db->where('auid',$this->auid)->update($data);
            }
            else
            {
                // 增
                $result = $this->db->insert($data);
            }
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
        $data['auid'] = $this->auid;
        $data['pid'] = serialize(input('post.pid/a'));
        $data['ctime'] = time();
        return $data;
    }

}
