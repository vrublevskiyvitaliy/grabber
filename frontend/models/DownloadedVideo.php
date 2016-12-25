<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "downloaded_video".
 *
 * @property integer $downloaded_video_id
 * @property integer $video_page_id
 * @property string $log
 * @property string $create_time
 *
 * @property VideoPage $videoPage
 */
class DownloadedVideo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'downloaded_video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_page_id', 'log'], 'required'],
            [['video_page_id'], 'integer'],
            [['log'], 'string'],
            [['create_time'], 'safe'],
            [['video_page_id'], 'exist', 'skipOnError' => true, 'targetClass' => VideoPage::className(), 'targetAttribute' => ['video_page_id' => 'video_page_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'downloaded_video_id' => 'Downloaded Video ID',
            'video_page_id' => 'Video Page ID',
            'log' => 'Log',
            'create_time' => 'Create Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoPage()
    {
        return $this->hasOne(VideoPage::className(), ['video_page_id' => 'video_page_id']);
    }

    public function getPrettyLog()
    {
        $log = $this->log;
        $log = str_replace("[", "<br>[", $log);
        return $log;
    }
}
