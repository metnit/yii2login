<?php

namespace app\models;
use Yii;

class User extends \yii\db\ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password',], 'string', 'max' => 250],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'user_image' => 'User Image',
        ];
    }

    public function findUsername($username){
        $user = User::find()->where('username =:username',[':username'=>$username])->one();
        if(!empty($user)){
            return '0';
        }else{
            return '1';
        }
    }

    public function login($username,$password){

             $user = User::find()->where('username =:username',[':username'=>$username])->one();

             if(!empty($user)){

                $data = User::find()->where('username =:username AND password=:password',[':username'=>$username,':password'=>$password])->one();

                if(!empty($data)){

                        $session = Yii::$app->session;
                        $session->open();
                        $session['id']= $data->id;
                        $session['username']= $data->username;
                        $session['user_image'] = isset($data->user_image)?$data->user_image:'';
                        $session->close();

                        return $data;

                }else{
                    return '1';
                }

             }else{

                return '2';
             }

    }

    public function checkEmail($email){
        if($email){
            return $email;
        }else{  
            return '-';
        }
    }

    public function photoView($image){
        if($image){
            return '<img src="'.$image.'" style="width:150px;height:150px" class="img-thumbnail">';
        }else{
            return '-';
        }
    }



}
