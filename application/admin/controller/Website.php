<?php
namespace app\admin\controller;
class Website extends Base
{
    public $db;
    public $id;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->db = db('website');
        $this->id = input('?get.id') ? input('get.id') : 0;
        $this->assign('active','Website');
    }

    /**
     * 添加站点信息页面
     */
    public function add()
    {
        $this->assign('action','Website/add');
        // Get
        if ($this->request->isGet())
        {
            // 查
            $data = $this->db->find();
            // assign
            $this->assign('data',$data);
            $this->assign('id',$data['id']);
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
    public function getData()
    {
        $data['service_qq'] = input('post.service_qq');
        $data['service_tel'] = input('post.service_tel');
        $data['title'] = input('post.title');
        $data['describe'] = input('post.describe');
        $data['search_keywords'] = input('post.search_keywords');
        $data['status'] = input('post.status');
        $data['ctime'] = time();
        return $data;
    }

}
