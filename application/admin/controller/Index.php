<?php
namespace app\admin\controller;
class Index extends Base
{
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->assign('active','Index');
        $this->assign('action','Index');
    }

    /**
     * 默认方法
     */
    public function index()
    {
        // Get
        if ($this->request->isGet())
        {
            // 统计访问量
            $data['website_pvCount'] = db('website_pv')->value('pv');

            // 统计栏目数
            $data['programaCount'] = db('programa')->count();
            // 统计栏目文章数
            $data['programa_articleCount'] = db('programa_article')->count();
            // 统计后台用户数
            $data['admin_userCount'] = db('admin_user')->count();
            // 统计banner数
            $data['bannerCount'] = db('banner')->count();
            // 统计活动预告广告图片数
            $data['ad_foreshowCount'] = db('ad_foreshow')->count();
            // 统计院校推荐广告图片数
            $data['ad_academyCount'] = db('ad_academy')->count();
            // 统计顶部广告图片数
            $data['ad_topCount'] = db('ad_top')->count();
            // 统计资讯热线广告图片数
            $data['ad_informationCount'] = db('ad_information')->count();
            // 统计院校发布广告图片数
            $data['ad_academy_topCount'] = db('ad_academy_top')->count();
            // 统计考试资讯广告图片数
            $data['ad_exam_topCount'] = db('ad_exam_top')->count();
            // 统计合作伙伴广告图片数
            $data['ad_partnerCount'] = db('ad_partner')->count();
            // 统计Logo图片数
            $data['ad_logoCount'] = db('ad_logo')->count();
            // 统计友情链接数
            $data['blogrollCount'] = db('blogroll')->count();

            // assign
            $this->assign('data',$data);
            // 渲染模板输出
            return $this->fetch('index');
        }
    }

    /**
     * 退出
     */
    public function logout()
    {
        // Get
        if ($this->request->isGet())
        {
            session(null);
            header("Location:/admin/Login/index");
            die;
        }
    }
}
