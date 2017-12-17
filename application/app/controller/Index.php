<?php
namespace app\app\controller;
class Index extends Base
{
    /**
     * 构造方法
     */
    public function _auto()
    {

    }

    /**
     * 移动端首页
     */
    public function index()
    {
        // Get
        if ($this->request->isGet())
        {
            // 读取招考公告
            $this->data['announcementData'] = db('programa_article')->where('status',0)->where('type',4)->order('ctime desc')->limit(6)->field('content',true)->select();
            // 读取院校推荐
            $this->data['recommendData'] = db('programa_article')->where('status',0)->where('type',6)->order('ctime desc')->limit(6)->field('content',true)->select();
            // 读取MBA热点关注
            $this->data['hotData'] = db('programa_article')->where('status',0)->where('type',3)->order('ctime desc')->limit(6)->field('content',true)->select();
            // 读取MBA活动预告
            $this->data['foreshowData'] = db('programa_article')->where('status',0)->where('type',5)->order('ctime desc')->limit(6)->field('content',true)->select();
            // 读取招生资讯
            $this->data['recruitData'] = db('programa_article')->where('status',0)->where('type',7)->order('ctime desc')->limit(6)->field('content',true)->select();
            // 读取考试资讯
            $this->data['examData'] = db('programa_article')->where('status',0)->where('type',8)->order('ctime desc')->limit(6)->field('content',true)->select();
            // assign
            $this->assign('data',$this->data);
            // 渲染模板输出
            return $this->fetch('index');
        }
    }
}
