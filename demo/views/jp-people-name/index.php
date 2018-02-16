<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JpPeopleNameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jp People Names';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jp-people-name-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kanji',
            'kana',
            [
                'attribute' => 'type',
                'filter' =>
            ],
        ],
    ]); ?>
</div>
