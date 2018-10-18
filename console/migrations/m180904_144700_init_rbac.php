<?php

use yii\db\Migration;

/**
 * Class m180904_144700_init_rbac
 */
class m180904_144700_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // 管理后台管理员权限
        $manageAdmin = $auth->createRole('manageAdmin');
        $manageAdmin->description = '管理员';
        $auth->add($manageAdmin);

        // 查看列表
        $adminList = $auth->createPermission('adminList');
        $adminList->description = '管理员列表';
        $adminList->data = '/admin-user/list';
        $auth->add($adminList);

        // 新增管理员
        $addAdmin = $auth->createPermission('addAdmin');
        $addAdmin->description = '新增管理员';
        $addAdmin->data = '/admin-user/add';
        $auth->add($addAdmin);

        // 删除管理员
        $delAdmin = $auth->createPermission('delAdmin');
        $delAdmin->description = '删除管理员';
        $addAdmin->data = '/admin-user/del';
        $auth->add($delAdmin);

        // 将管理员的查看、新增、删除作为管理员权限的子权限
        $auth->addChild($manageAdmin, $adminList);
        $auth->addChild($manageAdmin, $addAdmin);
        $auth->addChild($manageAdmin, $delAdmin);

        // 角色管理
        $manageRole = $auth->createRole('manageRole');
        $manageRole->description = '角色';
        $auth->add($manageRole);

        // 角色列表
        $roleList = $auth->createPermission('roleList');
        $roleList->description = '角色列表';
        $roleList->data = '/role/list';
        $auth->add($roleList);

        // 角色列表
        $addRole = $auth->createPermission('addRole');
        $addRole->description = '新增角色';
        $addRole->data = 'role/add';
        $auth->add($addRole);

        // 角色列表
        $delRole = $auth->createPermission('delRole');
        $delRole->description = '删除角色';
        $delRole->data = 'role/del';
        $auth->add($delRole);

        // 将角色的查看、新增、删除作为角色管理的子权限
        $auth->addChild($manageRole, $roleList);
        $auth->addChild($manageRole, $addRole);
        $auth->addChild($manageRole, $delRole);
        
        // 添加超级管理员角色
        $super_admin = $auth->createRole('superAdmin');
        $super_admin->description = '超级管理员';
        $auth->add($super_admin);
        // 给超管赋予管理员管理和角色管理等权限
        $auth->addChild($super_admin, $manageAdmin);
        $auth->addChild($super_admin, $manageRole);

        // 指派超管用户
        $auth->assign($super_admin, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180904_144700_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
