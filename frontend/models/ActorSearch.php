<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Actor;

/**
 * ActorSearch represents the model behind the search form about `frontend\models\Actor`.
 */
class ActorSearch extends Actor
{
    public $videoPageId;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actor_id', 'videoPageId'], 'integer'],
            [['actor_name'], 'safe'],
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
        $query = Actor::find();

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

        if (isset($this->videoPageId)) {
            $query->joinWith('videoPages');
            $query->andWhere(['actor_to_video_page.video_page_id' => $this->videoPageId]);
            $query->distinct();
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'actor_id' => $this->actor_id,
        ]);

        $query->andFilterWhere(['like', 'actor_name', $this->actor_name]);

        return $dataProvider;
    }
}
