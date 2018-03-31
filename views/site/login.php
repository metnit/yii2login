<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login" ng-controller="LoginController">
    <h1><?= Html::encode($this->title) ?></h1>
    

    <form id="login-form" class="form-horizontal ng-pristine ng-valid" >

        <?= Html::csrfMetaTags() ?>
        <div class="form-group field-loginform-username required">
        <label class="col-lg-1 control-label" for="loginform-username">Username</label>
        <div class="col-lg-3"><input type="text" id="loginform-username" class="form-control"  autofocus="" aria-required="true"></div>
         <div class="col-lg-11 col-lg-offset-1"><p class="help-block help-block-error username-error"></p></div>
        </div>

        <div class="form-group field-loginform-password required">
        <label class="col-lg-1 control-label" for="loginform-password">Password</label>
        <div class="col-lg-3"><input type="password" id="loginform-password" class="form-control"  value="" aria-required="true"></div>
        <div class="col-lg-11 col-lg-offset-1"><p class="help-block help-block-error password-error"></p></div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
            <button type="button" class="btn btn-primary" id="login-button">Login</button>
            </div>
        </div>

    </form>

</div>
