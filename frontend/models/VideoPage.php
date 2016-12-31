<?php

namespace frontend\models;

use frontend\helpers\VideoHelper;
use Yii;

use common\models\DownloadQueue;

use frontend\helpers\PathHelper;

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
 * @property string $like_status
 * @property string $is_hidden
 * @property string $is_downloaded
 * @property integer $origin_video_page_id
 * @property string $preview_status
 * @property integer $duration
 *
 * @property DownloadQueue[] $downloadQueues
 * @property DownloadedVideo[] $downloadedVideos
 * @property StartLinks $startLink
 * @property VideoPage $originVideoPage
 * @property VideoPage[] $videoPages
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
            [['start_link_id', 'origin_video_page_id', 'duration'], 'integer'],
            [['create_time', 'post_time'], 'safe'],
            [['like_status', 'is_hidden', 'is_downloaded', 'preview_status'], 'string'],
            [['url', 'image_url', 'tittle'], 'string', 'max' => 255],
            [['start_link_id'], 'exist', 'skipOnError' => true, 'targetClass' => StartLinks::className(), 'targetAttribute' => ['start_link_id' => 'start_link_id']],
            [['origin_video_page_id'], 'exist', 'skipOnError' => true, 'targetClass' => VideoPage::className(), 'targetAttribute' => ['origin_video_page_id' => 'video_page_id']],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->duration = VideoHelper::getDuration($this);
            return true;
        }
        return false;
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
            'like_status' => 'Like Status',
            'is_hidden' => 'Is Hidden',
            'is_downloaded' => 'Is Downloaded',
            'origin_video_page_id' => 'Origin Video Page ID',
            'preview_status' => 'Preview Status',
            'duration' => 'Duration',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDownloadQueues()
    {
        return $this->hasMany(DownloadQueue::className(), ['video_page_id' => 'video_page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDownloadedVideos()
    {
        return $this->hasMany(DownloadedVideo::className(), ['video_page_id' => 'video_page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToDownloadVideos()
    {
        return $this->hasMany(DownloadQueue::className(), ['video_page_id' => 'video_page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartLink()
    {
        return $this->hasOne(StartLinks::className(), ['start_link_id' => 'start_link_id']);
    }

    public function getFileSize()
    {
        return PathHelper::getFileSizeInMb($this);
    }

    public function getFileSizePrettyString()
    {
        return PathHelper::getFileSizeInMbPrettyString($this);
    }

    public function getLastDownloadFile()
    {
        $downloadFile = DownloadedVideo::find()
            ->where(['video_page_id' => $this->video_page_id])
            ->orderBy('create_time DESC')
            ->one();

        return $downloadFile;
    }

    public function isInDownloadQueue()
    {
        return $this->getToDownloadVideos()->where(['download_status' => 'download_now'])->count();
    }

    public function isDownloadingRightNow()
    {
        return $this->getToDownloadVideos()->where(['download_status' => 'downloading'])->count();
    }

    public function getPrettyDuration()
    {
        if (empty($this->duration)) {
            return '';
        }

        return gmdate("H:i:s", $this->duration);
    }
}
