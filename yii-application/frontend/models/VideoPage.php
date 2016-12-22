<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "video_page".
 *
 * @property integer $video_page_id
 * @property integer $start_link_id
 * @property string $url
 * @property string $image_url
 * @property string $tittle
 * @property string $create_time
 * @property string $post_time
 *
 * @property StartLinks $startLink
 */
class VideoPage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_link_id', 'url', 'image_url', 'tittle'], 'required'],
            [['start_link_id'], 'integer'],
            [['create_time', 'post_time'], 'safe'],
            [['url', 'image_url', 'tittle'], 'string', 'max' => 255],
            [['start_link_id'], 'exist', 'skipOnError' => true, 'targetClass' => StartLinks::className(), 'targetAttribute' => ['start_link_id' => 'start_link_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'video_page_id' => 'Video Page ID',
            'start_link_id' => 'Start Link ID',
            'url' => 'Url',
            'image_url' => 'Image Url',
            'tittle' => 'Tittle',
            'create_time' => 'Create Time',
            'post_time' => 'Post Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartLink()
    {
        return $this->hasOne(StartLinks::className(), ['start_link_id' => 'start_link_id']);
    }
}
