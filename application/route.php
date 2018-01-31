<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    'zs/:pid'        =>  ['Message/message',['ext'=>'shtml']],
    'yx/:pid'        =>  ['Message/message',['ext'=>'shtml']],
    'ks/:pid'        =>  ['Message/message',['ext'=>'shtml']],
    'zsmore/:type'   =>  ['Message/message',['ext'=>'shtml']],
    'yxmore/:type'   =>  ['Message/message',['ext'=>'shtml']],
    'ksmore/:type'   =>  ['Message/message',['ext'=>'shtml']],
    'd/:pid/:paid'   =>  ['Websitewap/websitewap',['ext'=>'shtml']],

];
