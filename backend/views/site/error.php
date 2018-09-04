<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto ">
            <h3 class="m-subheader__title ">
                <?= Html::encode($this->title) ?>
            </h3>
            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>
            <p>
                请求Web服务器时发生错误。
            </p>
            <p>
                如果您认为这是一个服务器错误，请与我们联系。谢谢你！
            </p>
        </div>
    </div>
</div>
