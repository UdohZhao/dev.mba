<?php
namespace app\app\controller;
use think\Controller;
/**
 * index模块基础控制器Base
 */
class Base extends Controller
{
    /**
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
        // 读取banner
        $this->data['bannerData'] = db('banner')->where('status',0)->order('ctime desc')->select();
        // 读取栏目子级
        $this->data['programaData'] = db('programa')->where('pid','>','0')->select();
        foreach ($this->data['programaData'] AS $k => $v)
        {
            // 读取院校子级发布的文章
            if ($v['type'] == 1)
            {
                $this->data['programaData'][$k]['programa_articleData'] = db('programa_article')->where('status',0)->where('pid',$v['id'])->order('ctime desc')->limit(6)->field('content',true)->select();
            }
            // 读取考试子级发布的文章
            if ($v['type'] == 2)
            {
                $this->data['programaData'][$k]['programa_articleData'] = db('programa_article')->where('status',0)->where('pid',$v['id'])->order('ctime desc')->limit(6)->field('content',true)->select();
            }
        }
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

        // 模板变量赋值
        $this->assign('data',$this->data);
        // 渲染模板输出
        return $this->fetch('/message/message');
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
