<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\VideoPage;

/**
 * VideoPageSearch represents the model behind the search form about `frontend\models\VideoPage`.
 */
class VideoPageSearch extends VideoPage
{
    public $startLinkTitle;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_page_id', 'start_link_id'], 'integer'],
            [['url', 'image_url', 'tittle', 'is_downloaded', 'startLinkTitle'], 'safe'],
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
        $query = VideoPage::find();

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

        $query->joinWith('startLink');

        // grid filtering conditions
        $query->andFilterWhere([
            'video_page_id' => $this->video_page_id,
            'start_link_id' => $this->start_link_id,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', VideoPage::tableName() . '.tittle', $this->tittle])
            ->andFilterWhere(['like', StartLinks::tableName() . '.tittle', $this->startLinkTitle]);

        if ($this->is_downloaded == 'yes') {
            $query->joinWith('downloadedVideos')
                ->distinct()
                ->orderBy(DownloadedVideo::tableName() . '.create_time DESC, video_page_id ASC');
            $query->andFilterWhere(['is_downloaded' => 'yes']);
        } else {
            $query->orderBy('create_time DESC, video_page_id ASC');
        }

        return $dataProvider;
    }
}
