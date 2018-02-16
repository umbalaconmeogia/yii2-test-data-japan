<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\JpAddress;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JpAddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jp Addresses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jp-address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'address_cd',
            'prefecture_cd',
//             'city_ward_town_village_cd',
//             'town_area_cd',
            'zipcode',
            [
                'attribute' => 'office_flag',
                'filter' => JpAddress::officeFlagOptionArr(),
            ],
//             'abolition_flag',
            'prefecture',
            'prefecture_kana',
            'city_ward_town_village',
            'city_ward_town_village_kana',
            'town_area',
            'town_area_kana',
            'town_area_complement',
            'kyoto_street_name',
            'aza_cho_me',
            'aza_cho_me_kana',
            'remarks',
            'office_name',
            'office_name_kana',
            'office_address',
            'new_address_cd',

//             [
//                 'class' => 'yii\grid\ActionColumn',
//                 'template' => '{view}',
//             ],
        ],
    ]); ?>
</div>
