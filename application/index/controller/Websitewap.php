<?php
namespace app\index\controller;
class Websitewap extends Base
{
    public $paid;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->paid = input('?get.paid') ? input('get.paid') : 0;
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
        // 读取Logo
            $data['ad_logoData'] = db('ad_logo')->where('status',0)->find();
            // 读取顶部广告
            $data['ad_topData'] = db('ad_top')->where('status',0)->find();
            // 读取栏目
            $data['programaData'] = db('programa')->where('pid',0)->select();
            // 读取栏目子级
            if ($data['programaData'])
            {
                foreach ($data['programaData'] AS $k => $v)
                {
                    $data['programaData'][$k]['programaSonData'] = db('programa')->where('pid',$v['id'])->select();
                    foreach ($data['programaData'][$k]['programaSonData'] AS $kk => $vv)
                    {
                        // 读取院校子级发布的文章
                        if ($vv['type'] == 1)
                        {
                            $data['programaData'][$k]['programaSonData'][$kk]['programa_articleData'] = db('programa_article')->where('status',0)->where('pid',$vv['id'])->order('ctime desc')->limit(7)->select();
                        }
                        // 读取考试子级发布的文章
                        if ($vv['type'] == 2)
                        {
                            $data['programaData'][$k]['programaSonData'][$kk]['programa_articleData'] = db('programa_article')->where('status',0)->where('pid',$vv['id'])->order('ctime desc')->limit(7)->select();
                        }
                    }
                }
            }
            // 读取banner
            $data['bannerData'] = db('banner')->where('status',0)->order('ctime desc')->select();
            // 读取MBA热点关注
            $data['hotData'] = db('programa_article')->where('status',0)->where('type',3)->order('ctime desc')->limit(6)->select();
            // 读取招考公告
            $data['announcementData'] = db('programa_article')->where('status',0)->where('type',4)->order('ctime desc')->limit(4)->select();
            // 读取MBA活动预告广告
            $data['ad_foreshowData'] = db('ad_foreshow')->where('status',0)->find();
            // 读取MBA活动预告
            $data['foreshowData'] = db('programa_article')->where('status',0)->where('type',5)->order('ctime desc')->limit(6)->select();
            // 读取招生资讯
            $data['recruitData'] = db('programa_article')->where('status',0)->where('type',7)->order('ctime desc')->limit(7)->select();
            // 读取考试资讯
            $data['examData'] = db('programa_article')->where('status',0)->where('type',8)->order('ctime desc')->limit(5)->select();
            // 读取院校推荐
            $data['recommendData'] = db('programa_article')->where('status',0)->where('type',6)->order('ctime desc')->limit(5)->select();
            // 读取院校推荐广告
            $data['ad_academyData'] = db('ad_academy')->where('status',0)->find();
            // 读取资讯热线广告
            $data['ad_informationData'] = db('ad_information')->where('status',0)->find();
            // 读取手机二维码广告
            $data['qr_code_phoneData'] = db('qr_code_phone')->where('status',0)->find();
            // 读取公众号二维码广告
            $data['qr_code_publicData'] = db('qr_code_public')->where('status',0)->find();
            // 读取院校发布上方广告
            $data['ad_academy_topData'] = db('ad_academy_top')->where('status',0)->order('ctime desc')->select();
            // 读取考试资讯上方广告
            $data['ad_exam_topData'] = db('ad_exam_top')->where('status',0)->order('ctime desc')->select();
            // 读取合作伙伴广告
            $data['ad_partnerData'] = db('ad_partner')->where('status',0)->order('ctime desc')->select();
            // 读取友情链接
            $data['blogrollData'] = db('blogroll')->where('status',0)->order('ctime desc')->select();
            // 读取底部信息
            $data['webstatData'] = db('webstat')->find();
        // 根据当前栏目文章id查询
        $data = db('programa_article')->where('id',$this->paid)->find();

        // 模板变量赋值
        $this->assign('data',$data);
        // 渲染模板输出
        return $this->fetch('websitewap');
        
    }

}
