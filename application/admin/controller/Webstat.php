<?php
namespace app\admin\controller;
class Webstat extends Base
{
    public $db;
    public $id;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->db = db('webstat');
        $this->id = input('?get.id') ? input('get.id') : 0;
    }

    /**
     * 添加关于我们页面
     */
    public function add()
    {
        // Get
        if ($this->request->isGet())
        {
            $data = $this->db->find();
            if ($data)
            {
                $this->id = $data['id'];
            }
            else
            {
              $data = '';
            }
            // assign
            $this->assign('data',$data);
            $this->assign('id',$this->id);
            // 渲染模板输出
            return $this->fetch('add');
        }
        // Ajax
        if ($this->request->isAjax())
        {
            // content
            $content = input('?post.content') ? input('post.content') : '';
            if ($content == false)
            {
              return ajaxReturn(Rs(2,'内容不能为空！',''));
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
        $data['content'] = input('post.content');
        $data['ctime'] = time();
        return $data;
    }

}
