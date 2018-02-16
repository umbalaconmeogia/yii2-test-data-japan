<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JpAddress */

$this->title = 'Update Jp Address: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Jp Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jp-address-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
