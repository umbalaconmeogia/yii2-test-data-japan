<?php

namespace app\models;

use app\models\JpAddress;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * JpAddressSearch represents the model behind the search form of `app\models\JpAddress`.
 */
class JpAddressSearch extends JpAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'address_cd', 'prefecture_cd', 'city_ward_town_village_cd', 'town_area_cd', 'office_flag', 'abolition_flag', 'new_address_cd'], 'integer'],
            [['zipcode', 'prefecture', 'prefecture_kana', 'city_ward_town_village', 'city_ward_town_village_kana', 'town_area', 'town_area_kana', 'town_area_complement', 'kyoto_street_name', 'aza_cho_me', 'aza_cho_me_kana', 'remarks', 'office_name', 'office_name_kana', 'office_address'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = JpAddress::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'address_cd' => $this->address_cd,
            'prefecture_cd' => $this->prefecture_cd,
            'city_ward_town_village_cd' => $this->city_ward_town_village_cd,
            'town_area_cd' => $this->town_area_cd,
            'office_flag' => $this->office_flag,
            'abolition_flag' => $this->abolition_flag,
            'new_address_cd' => $this->new_address_cd,
        ]);

        $query->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'prefecture', $this->prefecture])
            ->andFilterWhere(['like', 'prefecture_kana', $this->prefecture_kana])
            ->andFilterWhere(['like', 'city_ward_town_village', $this->city_ward_town_village])
            ->andFilterWhere(['like', 'city_ward_town_village_kana', $this->city_ward_town_village_kana])
            ->andFilterWhere(['like', 'town_area', $this->town_area])
            ->andFilterWhere(['like', 'town_area_kana', $this->town_area_kana])
            ->andFilterWhere(['like', 'town_area_complement', $this->town_area_complement])
            ->andFilterWhere(['like', 'kyoto_street_name', $this->kyoto_street_name])
            ->andFilterWhere(['like', 'aza_cho_me', $this->aza_cho_me])
            ->andFilterWhere(['like', 'aza_cho_me_kana', $this->aza_cho_me_kana])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'office_name', $this->office_name])
            ->andFilterWhere(['like', 'office_name_kana', $this->office_name_kana])
            ->andFilterWhere(['like', 'office_address', $this->office_address]);

        return $dataProvider;
    }
}
