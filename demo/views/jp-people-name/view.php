<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JpPeopleName */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jp People Names', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jp-people-name-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kanji',
            'kana',
            'type',
        ],
    ]) ?>

</div>
