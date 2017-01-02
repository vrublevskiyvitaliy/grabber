<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "actor_to_video_page".
 *
 * @property integer $actor_to_video_page_id
 * @property integer $actor_id
 * @property integer $video_page_id
 *
 * @property Actor $actor
 * @property VideoPage $videoPage
 */
class ActorToVideoPage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actor_to_video_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actor_id', 'video_page_id'], 'required'],
            [['actor_id', 'video_page_id'], 'integer'],
            [['actor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Actor::className(), 'targetAttribute' => ['actor_id' => 'actor_id']],
            [['video_page_id'], 'exist', 'skipOnError' => true, 'targetClass' => VideoPage::className(), 'targetAttribute' => ['video_page_id' => 'video_page_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'actor_to_video_page_id' => 'Actor To Video Page ID',
            'actor_id' => 'Actor ID',
            'video_page_id' => 'Video Page ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActor()
    {
        return $this->hasOne(Actor::className(), ['actor_id' => 'actor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoPage()
    {
        return $this->hasOne(VideoPage::className(), ['video_page_id' => 'video_page_id']);
    }
}
