<?php
namespace app\admin\controller;
use think\Controller;
/**
 * admin模块基础控制器Base
 */
class Base extends Controller
{
    /**
     * 构造方法
     */
    public function _initialize()
    {
      // 初始化构造方法
      if(method_exists($this,'_auto'))
      {
        $this->_auto();
      }

      // 请登录
      if (!session('?adminUser'))
      {
        header('Location:/admin/Login/index');
        die;
      }
        $this->assign('active','Base');
    }

    /**
     * 文件上传
     */
    public function fileUpload()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');

        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                return ajaxReturn(Rs(0, '上传成功！', DS . 'static' . DS . 'uploads' . DS . $info->getSaveName()));
            }else{
                // 上传失败获取错误信息
                return ajaxReturn(Rs(1,'上传失败！',$file->getError()));
            }
        }
    }

    /**
     * 删除文件
     */
    public function fileDel()
    {
        // 删除当前图片
        $path = ROOT_PATH . 'public' . input('post.path');
        @unlink($path);
        return ajaxReturn($path);
    }

    /**
     * 快捷通道
     */
    public function search()
    {
        $this->assign('action','Base/search');
        // Get
        if ($this->request->isGet())
        {
            // 渲染模板输出
            return $this->fetch('search');
        }
        // Post
        if ($this->request->isPost())
        {
            // 关键词
            $search = input('post.search');
            // if
            // if ()
            // {

            // }
        }
    }

}
