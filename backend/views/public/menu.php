<?php
/**
 * Author: jiangm
 * Email: jmphper@foxmail.com
 * Date: 2018/9/3
 * Time: 17:54
 * Desc: 菜单栏
 */

use yii\helpers\Url;

// 获取权限
$auth = Yii::$app->authManager;
$permissions = $auth->getPermissionsByUser(Yii::$app->user->getId());

$menus = [
    [
        'name' => '页面模板',
        'child' => [
            [
                'name'=>'页面模板',
                'icon' => 'flaticon-layers',
                'child'=>[
                    [
                        'name' => '图片上传',
                        'uri' => '/demo/image-upload',
                    ],
                ]
            ],
        ],
    ],
    [
        'name' => '用户',
        'child' => [
            [
                'name' => '用户',
                'icon' => 'flaticon-layers',
                'child'=>[
                    [
                        'name' => '用户列表',
                        'uri' => '/demo/image-upload',
                    ],
                ]
            ],
            [
                'name'=>'等级',
                'icon' => 'flaticon-layers',
                'child'=>[
                    [
                        'name' => '等级列表',
                        'uri' => '/demo/image-upload',
                    ],
                ]
            ],
            [
                'name'=>'任务',
                'icon' => 'flaticon-layers',
                'child'=>[
                    [
                        'name' => '任务列表',
                        'uri' => '/demo/image-upload',
                    ],
                ]
            ],
        ],
    ],
    [
        'name' => '内容',
        'child' => [
            [
                'name'=>'文章',
                'icon' => 'flaticon-layers',
                'child'=>[
                    [
                        'name' => '文章列表',
                        'uri' => '/demo/image-upload',
                    ],
                    [
                        'name' => '文章类型',
                        'uri' => '/demo/image-upload',
                    ],
                    [
                        'name' => '文章标签',
                        'uri' => '/demo/image-upload',
                    ],
                ]
            ],
        ],
    ],
    [
        'name' => '广告',
        'child' => [
            [
                'name'=>'普通广告',
                'icon' => 'flaticon-layers',
                'child'=>[
                    [
                        'name' => '广告列表',
                        'uri' => '/demo/image-upload',
                    ],
                ]
            ],
        ],
    ],
    [
        'name' => '工具',
        'child' => [
            [
                'name'=>'数据统计',
                'icon' => 'flaticon-layers',
                'child'=>[
                    [
                        'name' => '全站数据统计',
                        'uri' => '/demo/image-upload',
                    ],
                ]
            ],
            [
                'name'=>'运营工具',
                'icon' => 'flaticon-layers',
                'child'=>[
                    [
                        'name' => '发送短信',
                        'uri' => '/demo/image-upload',
                    ],
                    [
                        'name' => '站内消息',
                        'uri' => '/demo/image-upload',
                    ],
                ]
            ],
            [
                'name'=>'缓存',
                'icon' => 'flaticon-layers',
                'child'=>[
                    [
                        'name' => '缓存管理',
                        'uri' => '/demo/image-upload',
                    ],
                ]
            ],
        ],
    ],
    [
        'name' => '系统',
        'child' => [
            [
                'name' => '管理员',
                'icon' => 'flaticon-user-settings',
                'child'=>[
                    [
                        'name' => '管理员管理',
                        'uri' => '/demo/image-upload',
                    ],
                    [
                        'name' => '角色管理',
                        'uri' => '/demo/image-upload',
                    ],
                ]
            ],
        ],
    ],
];
?>
<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    <div
        id="m_ver_menu"
        class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
        data-menu-vertical="true"
        data-menu-scrollable="false" data-menu-dropdown-timeout="500"
    >
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            <li class="m-menu__item  m-menu__item--active" aria-haspopup="true" >
                <a  href="<?=Url::to('/index')?>" class="m-menu__link ">
                    <i class="m-menu__link-icon la la-home"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                首页
                            </span>
                            <span class="m-menu__link-badge">
                                <span class="m-badge m-badge--danger">
                                    2
                                </span>
                            </span>
                        </span>
                    </span>
                </a>
            </li>

            <?php foreach($menus as $menu1): ?>
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">
                    <?=$menu1['name']?>
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
                <?php foreach($menu1['child'] as $menu2):?>
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                    <a  href="#" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon <?=$menu2['icon']?>"></i>
                        <span class="m-menu__link-text"><?=$menu2['name']?></span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu ">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <span class="m-menu__link">
                                    <span class="m-menu__link-text">
                                        <?=$menu2['name']?>
                                    </span>
                                </span>
                            </li>
                            <?php foreach($menu2['child'] as $menu3):?>
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="<?=$menu3['uri']?>" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
                                        <?=$menu3['name']?>
                                    </span>
                                </a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </li>
                <?php endforeach;?>
            <?php endforeach;?>
            
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
