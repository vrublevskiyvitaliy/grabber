<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\StartLinks;

/**
 * StartLinksSearch represents the model behind the search form about `frontend\models\StartLinks`.
 */
class StartLinksSearch extends StartLinks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_link_id', 'site_id'], 'integer'],
            [['url', 'tittle'], 'safe'],
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
        $query = StartLinks::find();

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
            'start_link_id' => $this->start_link_id,
            'site_id' => $this->site_id,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'tittle', $this->tittle]);

        return $dataProvider;
    }
}
