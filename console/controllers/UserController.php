<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/28
 * Time: 21:32
 */

namespace console\controllers;


use common\models\User;
use yii\console\Controller;

class UserController extends Controller
{
    /**
     * create init user
     */
    public function actionAdd()
    {
        echo "create initialization user \n";

        $username = $this->prompt('用户名：');
        $password = $this->prompt('密码：');
        $nickname = $this->prompt('昵称：');
        $email = $this->prompt('邮箱：');
        $phone = $this->prompt('电话：');

        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->nickname = $nickname;
        $user->email = $email;
        $user->phone = $phone;
        $user->created_at = time();

        if (!$user->save()) {
            foreach ($user->getErrors() as $errors) {
                foreach ($errors as $e) {
                    echo $e . "\n";
                }
            }
            return 1;
        }

        echo '创建成功' . "\n";
    }
}