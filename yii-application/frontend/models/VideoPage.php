<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "video_page".
 *
 * @property integer $video_page_id
 * @property integer $start_link_id
 * @property string $url
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
            [['start_link_id', 'url'], 'required'],
            [['start_link_id'], 'integer'],
            [['url'], 'string', 'max' => 255],
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
