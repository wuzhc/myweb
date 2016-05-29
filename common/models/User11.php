<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $phone
 * @property integer $card_id
 * @property string $nickname
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User11 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'created_at'], 'required'],
            [['card_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'phone', 'nickname'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['email'], 'unique'],
            [['phone'], 'unique'],
            [['card_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common\message', 'ID'),
            'username' => Yii::t('common\message', 'Username'),
            'auth_key' => Yii::t('common\message', 'Auth Key'),
            'password_hash' => Yii::t('common\message', 'Password Hash'),
            'password_reset_token' => Yii::t('common\message', 'Password Reset Token'),
            'email' => Yii::t('common\message', 'Email'),
            'phone' => Yii::t('common\message', 'Phone'),
            'card_id' => Yii::t('common\message', 'Card ID'),
            'nickname' => Yii::t('common\message', 'Nickname'),
            'status' => Yii::t('common\message', 'Status'),
            'created_at' => Yii::t('common\message', 'Created At'),
            'updated_at' => Yii::t('common\message', 'Updated At'),
        ];
    }
}
