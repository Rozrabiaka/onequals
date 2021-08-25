<?php

use yii\db\Migration;

/**
 * Class m210825_142053_add_rbac
 */
class m210825_142053_add_rbac extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        //define roles

        $moderatorRole = $auth->createRole('moderator');
        $auth->add($moderatorRole);

        $blogerRole = $auth->createRole('bloger');
        $auth->add($blogerRole);

        $adminRole = $auth->createRole('administrator');
        $auth->add($adminRole);

        $auth->addChild($adminRole, $moderatorRole);
        $auth->addChild($adminRole, $blogerRole);

        $auth->assign($adminRole, 1);
    }
}
