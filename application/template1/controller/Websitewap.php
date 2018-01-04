<?php
namespace app\template1\controller;
class Websitewap extends Base
{
    public $paid;
    public $pid;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->paid = input('?get.paid') ? input('get.paid') : 0;
        $this->pid = input('?get.pid') ? input('get.pid') : 0;
        $this->assign('pid',$this->pid);
        $this->assign('paid',$this->paid);
    }

     /**
     * 默认方法
     */
    public function websitewapDemo()
    {
        // Get
        if ($this->request->isGet()) {
            // 读取id号
            $data['status'] = 0; //0表示正常,1表示异常
            $data['msg'] = '正常';
            $data['data'] = '';
            // 组建数据
                //招生公告
            $data['data']['programa']['0']['id'] = '1';
            $data['data']['programa']['0']['pid'] = '0';
            $data['data']['programa']['0']['cname'] = '招生公告';
            $data['data']['programa']['0']['type'] = '0';

            $data['data']['programa']['1']['id'] = '2';
            $data['data']['programa']['1']['pid'] = '0';
            $data['data']['programa']['1']['cname'] = '考试咨询';
            $data['data']['programa']['1']['type'] = '0';

            $data['data']['programa']['2']['id'] = '3';
            $data['data']['programa']['2']['pid'] = '0';
            $data['data']['programa']['2']['cname'] = '热点公告';
            $data['data']['programa']['2']['type'] = '0';

            $data['data']['programa']['3']['id'] = '4';
            $data['data']['programa']['3']['pid'] = '0';
            $data['data']['programa']['3']['cname'] = '招考公告';
            $data['data']['programa']['3']['type'] = '1';

            // 院校
            $data['data']['programa2']['0']['id'] = '1';
            $data['data']['programa2']['0']['pid'] = '0';
            $data['data']['programa2']['0']['cname'] = '重庆大学';
            $data['data']['programa2']['0']['type'] = '1';

            $data['data']['programa2']['1']['id'] = '2';
            $data['data']['programa2']['1']['pid'] = '0';
            $data['data']['programa2']['1']['cname'] = '西南大学';
            $data['data']['programa2']['1']['type'] = '1';

            $data['data']['programa2']['2']['id'] = '3';
            $data['data']['programa2']['2']['pid'] = '0';
            $data['data']['programa2']['2']['cname'] = '师范大学';
            $data['data']['programa2']['2']['type'] = '1';

            $data['data']['programa2']['3']['id'] = '4';
            $data['data']['programa2']['3']['pid'] = '0';
            $data['data']['programa2']['3']['cname'] = '工商大学';
            $data['data']['programa2']['3']['type'] = '1';

            // 考试
            $data['data']['programa3']['0']['id'] = '1';
            $data['data']['programa3']['0']['pid'] = '0';
            $data['data']['programa3']['0']['cname'] = '初试';
            $data['data']['programa3']['0']['type'] = '1';

            $data['data']['programa3']['1']['id'] = '2';
            $data['data']['programa3']['1']['pid'] = '0';
            $data['data']['programa3']['1']['cname'] = '复试';
            $data['data']['programa3']['1']['type'] = '1';

            $data['data']['programa3']['2']['id'] = '3';
            $data['data']['programa3']['2']['pid'] = '0';
            $data['data']['programa3']['2']['cname'] = '英语';
            $data['data']['programa3']['2']['type'] = '1';

            $data['data']['programa3']['3']['id'] = '4';
            $data['data']['programa3']['3']['pid'] = '0';
            $data['data']['programa3']['3']['cname'] = '逻辑';
            $data['data']['programa3']['3']['type'] = '1';
            // 返回来自ajax的请求
            //return ajaxReturn($data);
            // 模板变量赋值
            $this->assign('data',$data);
            // 渲染模板输出
            return $this->fetch('websitewap');
        }
    }

    /**
     * PC端文章页面
     */
    public function websitewap()
    {
        // 读取当前栏目名称
        $this->data['programaCname'] = db('programa')->where('id',$this->pid)->value('cname');
        // 读取当前文章标题
        $this->data['programa_articleTitle'] = strip_tags(db('programa_article')->where('id',$this->paid)->value('title'));
        // 根据当前栏目文章id查询
        $this->data['programa_articleData'] = db('programa_article')->where('id',$this->paid)->find();
        // var_dump($this->data['programa_articleData']);
        // die;
        // 模板变量赋值
        $this->assign('data',$this->data);
        // 渲染模板输出
        return $this->fetch('websitewap');
    }

}
