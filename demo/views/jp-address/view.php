<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JpAddress */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jp Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jp-address-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'address_cd',
            'prefecture_cd',
            'city_ward_town_village_cd',
            'town_area_cd',
            'zipcode',
            'office_flag',
            'abolition_flag',
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
        ],
    ]) ?>

</div>
