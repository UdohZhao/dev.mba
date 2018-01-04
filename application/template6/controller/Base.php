<?php
namespace app\template6\controller;
use think\Controller;
/**
 * index模块基础控制器Base
 */
class Base extends Controller
{
    public $data;
    public $pid;
    public $paid;
    /**s
     * 构造方法
     */
    public function _auto()
    {
        $this->type = input('?get.type') ? input('get.type') : 0;
        $this->pid = input('?get.pid') ? input('get.pid') : 0;
        $this->paid = input('?get.paid') ? input('get.paid') : 0;
        $this->assign('pid',$this->pid);
        $this->assign('type',$this->type);
        $this->assign('paid',$this->paid);
    }

    public function _initialize()
    {
        // 判断是否为移动端访问
        if (isMobile())
        {
            // 站点关闭跳转提示
            header('Location:/app');
            die;
        }
        // 初始化构造方法
        if(method_exists($this,'_auto'))
        {
          $this->_auto();
        }
        // 读取站点信息
        $this->data['websiteData'] = db('website')->find();
        if ($this->data['websiteData']['status'] == 1)
        {
            // 站点关闭跳转提示
            header('Location:https://www.baidu.com/');
            die;
        }
        // 读取Logo
        $this->data['ad_logoData'] = db('ad_logo')->where('status',0)->find();
        // 读取顶部广告
        $this->data['ad_topData'] = db('ad_top')->where('status',0)->find();
        // 读取资讯热线广告
        $this->data['ad_informationData'] = db('ad_information')->where('status',0)->find();
        // 读取手机二维码广告
        $this->data['qr_code_phoneData'] = db('qr_code_phone')->where('status',0)->find();
        // 读取公众号二维码广告
        $this->data['qr_code_publicData'] = db('qr_code_public')->where('status',0)->find();
        // 读取院校推荐广告
        $this->data['ad_academyData'] = db('ad_academy')->where('status',0)->find();
        // 读取合作伙伴广告
        $this->data['ad_partnerData'] = db('ad_partner')->where('status',0)->order('ctime desc')->select();
        // 读取友情链接
        $this->data['blogrollData'] = db('blogroll')->where('status',0)->order('ctime desc')->select();
        // 读取底部信息
        $this->data['webstatData'] = db('webstat')->find();

        // 读取栏目
        $this->data['programaData'] = db('programa')->where('pid',0)->select();
 
            
        // 读取栏目子级
        if ($this->data['programaData'])
        {
            foreach ($this->data['programaData'] AS $k => $v)
            {
                $this->data['programaData'][$k]['programaSonData'] = db('programa')->where('pid',$v['id'])->select();
                foreach ($this->data['programaData'][$k]['programaSonData'] AS $kk => $vv)
                {
                    // 读取院校子级发布的文章
                    if ($vv['type'] == 1)
                    {
                        $this->data['programaData'][$k]['programaSonData'][$kk]['programa_articleData'] = db('programa_article')->where('status',0)->where('pid',$vv['id'])->order('ctime desc')->limit(4)->field('content',true)->select();
                    }
                    // 读取考试子级发布的文章
                    if ($vv['type'] == 2)
                    {
                        $this->data['programaData'][$k]['programaSonData'][$kk]['programa_articleData'] = db('programa_article')->where('status',0)->where('pid',$vv['id'])->order('ctime desc')->limit(4)->field('content',true)->select();
                    }
                }
            }
        }
        // 读取招考公告
        $this->data['announcementData'] = db('programa_article')->where('status',0)->where('type',4)->order('ctime desc')->limit(11)->field('content',true)->select();
        // 读取院校推荐
        $this->data['recommendData'] = db('programa_article')->where('status',0)->where('type',6)->order('ctime desc')->limit(5)->field('content',true)->select();
        // 读取网站地图
        $this->data['website_mapData'] = config('website_map');
    }

    /**
     * 搜索文章
     */

    public function search()
    {

        // 获取搜索关键词
        $search_keywords = "%%";
        if (input('?post.search')) $search_keywords = "%".input('post.search')."%";
        // 查
        $this->data['programa_articleData'] = db('programa_article')->where('status',0)->where('search_keywords','like',$search_keywords)->order('ctime desc')->field('content',true)->paginate(config('paging'));

            // if($this->data['programa_articleData'])
            // {
            //     foreach ($this->data['programa_articleData'] AS $k => $v) 
            //     {
            //         $this->data['programa_articleData'][$k]['programa_articleDataLst'] = db('programa')->where('pid',$v['id'])->select();
            //         if(data['programa_articleData'][$k]['programa_articleDataLst'])
            //         {}
            //         // 读取当前栏目名称
            //         $this->data['programaCname'] = db('programa')->where('id',$this->type)->value('cname');
            //         // 读取当前文章标题
            //         $this->data['programa_articleTitle'] = strip_tags(db('programa_article')->where('id',$this->paid)->value('title'));
            //         // 模板变量赋值
            //         $this->assign('data',$this->data);
            //          // 渲染模板输出
            //         return $this->fetch('message/message');
                    
            //     }

            // }

            $this->data['programaCname'] = db('programa')->where('id',$this->type)->value('cname');
            // 读取当前文章标题
            $this->data['programa_articleTitle'] = strip_tags(db('programa_article')->where('id',$this->paid)->value('title'));
            // 模板变量赋值
            $this->assign('data',$this->data);
             // 渲染模板输出
            return $this->fetch('message/message');
    }

    /**
     * 关于我们
     */
    public function aboutUs()
    {
        // 读取关于我们信息
        $this->data['about_usData'] = db('about_us')->find();
        // 模板变量赋值
        $this->assign('data',$this->data);
        // 渲染模板输出
        return $this->fetch('/sitemap/aboutUs');
    }

    /**
     * 网站地图
     */
    public function sitemap()
    {
         // 模板变量赋值
         $this->assign('data',$this->data);
         // 渲染模板输出
         return $this->fetch('/sitemap/sitemap');
        
    }

}
