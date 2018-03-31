<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login" ng-controller="LoginController">
    <h1><?= Html::encode($this->title) ?></h1>
    

    <form id="register-form" class="form-horizontal ng-pristine ng-valid"  enctype="multipart/form-data">

        <?= Html::csrfMetaTags() ?>
        <div class="form-group field-loginform-username required">
        <label class="col-lg-1 control-label" for="loginform-username">Username</label>
        <div class="col-lg-3"><input type="text" id="loginform-username" maxlength="12" name="username" class="form-control"   ></div>
        <input type="hidden" class="checkUser" value="0">
        <div class="col-lg-11 col-lg-offset-1"><p class="help-block help-block-error username-error"></p></div>
        </div>

        <div class="form-group field-loginform-password required">
        <label class="col-lg-1 control-label" for="loginform-password">Password</label>
        <div class="col-lg-3"><input type="password" id="loginform-password" name="password" class="form-control"  ></div>
        <div class="col-lg-11 col-lg-offset-1"><p class="help-block help-block-error password-error"></p></div>
        </div>

        <div class="form-group field-loginform-confirm-password required">
        <label class="col-lg-1 control-label" for="loginform-confirm-password">Confirm Password</label>
        <div class="col-lg-3"><input type="password" id="loginform-confirm-password" name="confirm-password" class="form-control"   ></div>
        <div class="col-lg-11 col-lg-offset-1"><p class="help-block help-block-error confirm-password-error"></p></div>

        </div>

        <div class="form-group field-loginform-email required">
        <label class="col-lg-1 control-label" for="loginform-email">Email</label>
        <div class="col-lg-3"><input type="text" id="loginform-email" name="email"  class="form-control"></div>
        <div class="col-lg-11 col-lg-offset-1"><p class="help-block help-block-error email-error"></p></div>
        </div>

        <div class="form-group field-loginform-image required">
        <label class="col-lg-1 control-label" for="loginform-image">Profile image</label>
        <div class="col-lg-3"><input type="file" name="image_form" id="image_form" class="form-control" accept="image/png, image/jpeg, image/gif"></div>
        <div class="col-lg-8"><p class="help-block help-block-error "></p></div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
            <button type="button" class="btn btn-primary" id="register-button">Submit</button>
            </div>
        </div>

    </form>

</div>
