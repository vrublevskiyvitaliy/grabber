<?php

namespace common\models;

use Yii;

use frontend\models\VideoPage;

/**
 * This is the model class for table "download_queue".
 *
 * @property integer $download_queue_id
 * @property integer $video_page_id
 * @property string $download_status
 * @property string $add_time
 *
 * @property VideoPage $videoPage
 */
class DownloadQueue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'download_queue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_page_id'], 'required'],
            [['video_page_id'], 'integer'],
            [['download_status'], 'string'],
            [['add_time'], 'safe'],
            [['video_page_id'], 'exist', 'skipOnError' => true, 'targetClass' => VideoPage::className(), 'targetAttribute' => ['video_page_id' => 'video_page_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'download_queue_id' => 'Download Queue ID',
            'video_page_id' => 'Video Page ID',
            'download_status' => 'Download Status',
            'add_time' => 'Add Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoPage()
    {
        return $this->hasOne(VideoPage::className(), ['video_page_id' => 'video_page_id']);
    }
}
