<?php
namespace app\admin\controller;
use think\Controller;
use think\captcha\Captcha;
/**
 * admin模块基础控制器Base
 */
class Login extends Controller
{
    public $cdb;
    public $audb;
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
      // 实例化验证码类
      $this->cdb = new Captcha();
      // 实例化用户model
      $this->audb = model('AdminUser');
      // 已登录
      if (session('?adminUser'))
      {
        header('Location:/admin/Index/index');
        die;
      }
    }

    /**
     * 登录页面
     */
    public function index()
    {
      // Get
      if ($this->request->isGet())
      {
          // 渲染模板输出
          return $this->fetch('index');
      }
      // Ajax
      if ($this->request->isAjax())
      {
        // 获取提交数据
        $data = $this->getData();
        $username = $data['username'];
        $password = $data['password'];
        $res = $this->audb->selects('*', "WHERE username = '$username' AND password = '$password'", '', '');
        // if
        if (!$res)
        {
          return ajaxReturn(Rs(1,'用户名或者密码错误！',''));
        }
        if ($res[0]['status'] == 1)
        {
          return ajaxReturn(Rs(2,'改用户已被冻结，暂时无法登录，请联系网站管理员！',''));
        }
        // 读取当前用户权限
        $res[0]['permissions'] = db('permissions')->where('auid',$res[0]['id'])->find();
        if ($res[0]['permissions'])
        {
            $res[0]['permissions']['pid'] = unserialize($res[0]['permissions']['pid']);
        }
        // 用户信息存入session
        session('adminUser',$res[0]);
        return ajaxReturn(Rs(0,'',''));
      }
    }

    /**
     * 获取数据
     */
    private function getData()
    {
      // post
      $data['username'] = input('post.username');
      $data['password'] = enPassword(input('post.password'));
      return $data;
    }

    /**
     * 生成验证码
     */
    public function captcha()
    {
      // Get
      if ($this->request->isGet())
      {
        return $this->cdb->entry();
      }
      // Ajax
      if ($this->request->isAjax())
      {
        if ($this->cdb->check(input('post.code'), ''))
        {
          return ['valid'=>true];
        }
        else
        {
          return ['valid'=>false];
        }
      }
    }
}
