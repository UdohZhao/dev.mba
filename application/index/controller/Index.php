<?php
namespace app\index\controller;
class Index extends Base
{
    /**
     * 构造方法
     */
    public function _auto()
    {

    }

    /**
     * 默认方法
     */
    public function indexDemo()
    {
        // Get
        if ($this->request->isGet()) {

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

            //院校广告上面列表
            $data['data']['ad_academy']['0']['id'] = '0';
            $data['data']['ad_academy']['0']['cname_link'] = '/websitewap/websitewap';
            $data['data']['ad_academy']['0']['cname'] = '重庆大学';

            $data['data']['ad_academy']['1']['id'] = '1';
            $data['data']['ad_academy']['1']['cname_link'] = '/websitewap/websitewap';
            $data['data']['ad_academy']['1']['cname'] = '西南大学';

            $data['data']['ad_academy']['2']['id'] = '2';
            $data['data']['ad_academy']['2']['cname_link'] = '/websitewap/websitewap';
            $data['data']['ad_academy']['2']['cname'] = '师范大学';

            $data['data']['ad_academy']['3']['id'] = '3';
            $data['data']['ad_academy']['3']['cname_link'] = '/websitewap/websitewap';
            $data['data']['ad_academy']['3']['cname'] = '重庆医学院';

            $data['data']['ad_academy']['4']['id'] = '4';
            $data['data']['ad_academy']['4']['cname_link'] = '/websitewap/websitewap';
            $data['data']['ad_academy']['4']['cname'] = '长江师范学院';

            $data['data']['ad_academy']['5']['id'] = '5';
            $data['data']['ad_academy']['5']['cname_link'] = '/websitewap/websitewap';
            $data['data']['ad_academy']['5']['cname'] = '西南政法大学';

            $data['data']['ad_academy']['6']['id'] = '6';
            $data['data']['ad_academy']['6']['cname_link'] = '/websitewap/websitewap';
            $data['data']['ad_academy']['6']['cname'] = '四川外语学院';

            $data['data']['ad_academy']['7']['id'] = '7';
            $data['data']['ad_academy']['7']['cname_link'] = '/websitewap/websitewap';
            $data['data']['ad_academy']['7']['cname'] = '邮电大学';

            $data['data']['ad_academy']['8']['id'] = '8';
            $data['data']['ad_academy']['8']['cname_link'] = '/websitewap/websitewap';
            $data['data']['ad_academy']['8']['cname'] = '交通大学';

            $data['data']['ad_academy']['9']['id'] = '9';
            $data['data']['ad_academy']['9']['cname_link'] = '/websitewap/websitewap';
            $data['data']['ad_academy']['9']['cname'] = '理工大学';

            $data['data']['ad_academy']['10']['id'] = '10';
            $data['data']['ad_academy']['10']['cname_link'] = '/websitewap/websitewap';
            $data['data']['ad_academy']['10']['cname'] = '文理学院';
            // 返回来自ajax的请求

            //首页信息列表
            $data['data']['programa_article']['0']['id'] = '0';
            $data['data']['programa_article']['0']['auid'] = '0';
            $data['data']['programa_article']['0']['pid'] = '0';
            $data['data']['programa_article']['0']['type'] = '1';
            $data['data']['programa_article']['0']['status'] = '0';
            $data['data']['programa_article']['0']['title'] = '北京交通大学2018年免TOEFL/IELTS/GMAT留学硕士项目招生';
            $data['data']['programa_article']['0']['tips'] = '石溪大学是纽约州立大学系统的四大旗舰院校之一，学校发展迅猛，成立40多年以来，已经成为美国一流的教学和研究中心。诺贝尔物理学奖获得者杨振宁教授在该校执教37年，在他的率领下，该校的理论物理研究所多次获得各种国际大奖。';
            $data['data']['programa_article']['2']['id'] = '1';
            $data['data']['programa_article']['2']['auid'] = '0';
            $data['data']['programa_article']['2']['pid'] = '1';
            $data['data']['programa_article']['2']['type'] = '0';
            $data['data']['programa_article']['2']['status'] = '0';
            $data['data']['programa_article']['2']['title'] = '国务院办公厅关于深化医教协同进一步推进医学教育改革与发展的意见';
            $data['data']['programa_article']['2']['tips'] = '各省、自治区、直辖市人民政府，国务院各部委、各直属机构';
            $data['data']['programa_article']['3']['id'] = '1';
            $data['data']['programa_article']['3']['auid'] = '0';
            $data['data']['programa_article']['3']['pid'] = '1';
            $data['data']['programa_article']['3']['type'] = '0';
            $data['data']['programa_article']['3']['status'] = '0';
            $data['data']['programa_article']['3']['title'] = '教育部关于印发《2018年全国硕士研究生招生工作管理规定》的通知';
            $data['data']['programa_article']['3']['tips'] = '各省、自治区、直辖市高等学校招生委员会、教育厅(教委)、教育招生考试机构，新疆生产建设兵团教育局，有关部门(单位)教育司(局)，中央军委训练管理部职业教育局，各硕士研究生招生单位：';
            $data['data']['programa_article']['4']['id'] = '1';
            $data['data']['programa_article']['4']['auid'] = '0';
            $data['data']['programa_article']['4']['pid'] = '1';
            $data['data']['programa_article']['4']['type'] = '0';
            $data['data']['programa_article']['4']['status'] = '0';
            $data['data']['programa_article']['4']['title'] = '医教协同，建设具有中国特色的医学人才培养体系';
            $data['data']['programa_article']['4']['tips'] = '建设健康中国，基础在教育，关键在人才。近日，国务院办公厅印发《关于深化医教协同进一步推进医学教育改革与发展的意见》(以下简称《意见》)。此次改革的重点任务和主要目标是什么?如何进一步提高医学人才培养质量?医学人才使用激励方面有何新突破?教育部、国家卫生计生委、国家中医药局负责人就有关问题回答了记者提问。';
            $data['data']['programa_article']['5']['id'] = '1';
            $data['data']['programa_article']['5']['auid'] = '0';
            $data['data']['programa_article']['5']['pid'] = '1';
            $data['data']['programa_article']['5']['type'] = '0';
            $data['data']['programa_article']['5']['status'] = '0';
            $data['data']['programa_article']['5']['title'] = '教育部：加快构建标准化规范化临床医学人才培养体系';
            $data['data']['programa_article']['5']['tips'] = '自2015年，教育部决定当年起将七年制临床医学专业招生调整为临床医学专业(“5+3”一体化)，实施一体化培养。目前，一体化人才培养已成为培养高水平高素质临床医师的重要途径，是标准化规范化临床医学人才培养体系的重要组成部分，是推进医学教育综合改革的重要内容。《意见》明确，一体化人才培养的培养目标';
            $data['data']['programa_article']['6']['id'] = '1';
            $data['data']['programa_article']['6']['auid'] = '0';
            $data['data']['programa_article']['6']['pid'] = '2';
            $data['data']['programa_article']['6']['type'] = '0';
            $data['data']['programa_article']['6']['status'] = '0';
            $data['data']['programa_article']['6']['title'] = '教育部关于进一步做好“5+3”一体化医学人才培养工作的若干意见';
            $data['data']['programa_article']['6']['tips'] = '2015年，教育部决定，自当年起将七年制临床医学专业招生调整为临床医学专业(“5+3”一体化)，即5年本科阶段合格者直接进入本校与住院医师规范化培训有机衔接的3年临床医学(含中医、口腔医学)硕士专业学位研究生教育阶段，实施一体化人才培养。一体化人才培养是培养高';
            //return ajaxReturn($data);
            // 模板变量赋值
            $this->assign('data',$data);
            // 渲染模板输出
            return $this->fetch('index');

    }

    }

    /**
     * PC端首页
     */
    public function index()
    {
        // Get
        if ($this->request->isGet())
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

            // assign
            $this->assign('data',$data);
            // 渲染模板输出
            return $this->fetch('index');
        }
    }



}
