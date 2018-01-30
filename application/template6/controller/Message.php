<?php
namespace app\template6\controller;
class Message extends Base
{
    public $type;
    public $pid;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->type = input('?get.type') ? input('get.type') : 0;
        $this->pid = input('?get.pid') ? input('get.pid') : 0;
        $this->assign('type',$this->type);
        $this->assign('pid',$this->pid);
    }

     /**
     * 默认方法
     */
    public function messageDemo()
    {
        // Get
        if ($this->request->isGet()) {
            $data['status'] = 0; //0表示正常,1表示异常
            $data['msg'] = '正常';
            $data['item'] = '';
            //组建数据
            $data['item']['0']['img'] = '/static/images/banner.png';
            $data['item']['0']['url'] = '/app/websitewap/websitewap';
            $data['item']['0']['title'] = '北京国家会计学院2018年专业学位硕士研究生招生简章';
            $data['item']['0']['content'] = '北京国家会计学院（招生单位代码80401）1998年7月20日由国务院于批准成立，为财政部事业单位。学院成立以来，秉承“诚信为本，操守为重，坚持准则，不做假账”的办学宗旨，为我国宏观经济管理部门、大中型企业以及社会中介机构培养了大批会计、审计及税务高级专业人才。';
            $data['item']['0']['ctime'] = '2017年09月06';

            $data['item']['1']['img'] = '/static/images/banner.png';
            $data['item']['1']['url'] = '/app/websitewap/websitewap';
            $data['item']['1']['title'] = '普通高等学校招生违规行为处理暂行办法';
            $data['item']['1']['content'] = '为规范对普通高等学校招生违规行为的处理，保证招生公开，适用本办法。';
            $data['ltem']['1']['ctime'] = '2014年08月11日';

            $data['item']['2']['img'] = '/static/images/banner.png';
            $data['item']['2']['url'] = '/app/websitewap/websitewap';
            $data['item']['2']['title'] = '北京国家会计学院2018年专业学位硕士研究生招生简章';
            $data['item']['2']['content'] = '北京国家会计学院（招生单位代码80401）1998年7月20日由国务院于批准成立，为财政部事业单位。学院成立以来，秉承“诚信为本，操守为重，坚持准则，不做假账”的办学宗旨，为我国宏观经济管理部门、大中型企业以及社会中介机构培养了大批会计、审计及税务高级专业人才。';
            $data['item']['2']['ctime'] = '2017年09月06';
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
            // 模板变量赋值
            $this->assign('data',$data);
            // 渲染模板输出
            return $this->fetch('message');
        }
    }


    public function item(){

    }

    /**
     * PC端栏目列表页面
     */
    public function message()
    {
        // Get
        if ($this->request->isGet())
        {
            // 读取当前栏目下的文章列表
            if ($this->pid) 
            {

                // 读取当前栏目名称
                $this->data['programaCname'] = db('programa')->where('id',$this->pid)->value('cname');
                $this->data['programa_articleData'] = db('programa_article')->where('status',0)->where('pid',$this->pid)->order('ctime desc')->field('content',true)->paginate(config('paging'),false,['query' => request()->param()]);

            }
            else 
            {
                // 读取当前栏目名称
                $this->data['programaCname'] = db('programa')->where('type',$this->type)->value('cname');
                $this->data['programa_articleData'] = db('programa_article')->where('status',0)->where('type',$this->type)->order('ctime desc')->field('content',true)->paginate(config('paging'),false,['query' => request()->param()]);
            }
            // 模板变量赋值
            $this->assign('data',$this->data);
            // 渲染模板输出
            return $this->fetch('message');
        }
    }

}
