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

        $username = $this->prompt('�û�����');
        $password = $this->prompt('���룺');
        $nickname = $this->prompt('�ǳƣ�');
        $email = $this->prompt('���䣺');
        $phone = $this->prompt('�绰��');

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

        echo '�����ɹ�' . "\n";
    }
}