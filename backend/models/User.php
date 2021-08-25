<?php

namespace backend\models;

use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property int $admin
 * @property int|null $user_role
 */
class User extends \yii\db\ActiveRecord
{
    const NAME_ROLE_USER_DEFAULT = 'Юзер';
    const NAME_ROLE_USER_WORK = 'Роботодавець';
    const NAME_ROLE_USER_SEARCH_WORK = 'Шукач';

    const USER_DEFAULT = 0;
    const USER_WORK = 1;
    const USER_SEARCH_WORK = 2;

    const ROLE_ADMIN = 'administrator';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_BLOGER = 'bloger';

    const USER_ADMIN = 1;
    const USER_NOT_ADMIN = 0;

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;


    public $roles;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'saveRoles']);
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'saveRoles']);
        $this->on(self::EVENT_AFTER_DELETE, [$this, 'removeRole']);
    }

    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['roles', 'trim'],
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'admin', 'user_role'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'admin' => 'Admin',
            'user_role' => 'User Role',
        ];
    }

    public function getUserRoleNameByRoleId($id)
    {
        if ($id == self::USER_DEFAULT) {
            return self::NAME_ROLE_USER_DEFAULT;
        } elseif ($id == self::USER_WORK) {
            return self::NAME_ROLE_USER_WORK;
        } else {
            return self::NAME_ROLE_USER_SEARCH_WORK;
        }
    }

    public function getUserAdminStatus($id)
    {
        $role = array_keys(Yii::$app->authManager->getRolesByUser($id))[0];
        if (!empty($role)) {
            if ($role == self::ROLE_MODERATOR) {
                return 'Модератор';
            } elseif ($role == self::ROLE_BLOGER) {
                return 'Блог';
            } elseif ($role == self::ROLE_ADMIN) {
                return 'Адміністратор';
            }
        }

        return 'Користувач';
    }

    public function getStatusActiveUserDropDown()
    {
        return array(
            self::STATUS_INACTIVE => 'Неактивний',
            self::STATUS_ACTIVE => 'Активний'
        );
    }

    public function getStatusActiveUserByStatusId($id)
    {
        if ($id == self::STATUS_INACTIVE) {
            return 'Неактивний';
        }
        return 'Активний';
    }

    public function getAdminDropDownCheckbox()
    {
        return array(
            self::USER_ADMIN => 'Дозволити вхід в адмім систему',
            self::USER_NOT_ADMIN => 'Заборонити вхід в адмін систему',
        );
    }

    public function getRolesDropdown()
    {
        return array(
            self::ROLE_ADMIN => 'Адміністратор',
            self::ROLE_MODERATOR => 'Модератор',
            self::ROLE_BLOGER => 'Блог',
        );
    }

    public function saveRoles()
    {
        Yii::$app->authManager->revokeAll($this->id);
        if (is_string($this->roles) and $role = Yii::$app->authManager->getRole($this->roles)) {
            Yii::$app->authManager->assign($role, $this->id);
        }
    }

    public function afterFind()
    {
        $this->roles = $this->getRole();
    }

    public function getRole()
    {
        $role = Yii::$app->authManager->getRolesByUser($this->id);
        return ArrayHelper::getColumn($role, 'name', false);
    }

    public function removeRole()
    {
        Yii::$app->authManager->revokeAll($this->id);
    }
}
