<?php

namespace frontend\models;

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
 *
 * @property DownloadedVideo[] $downloadedVideos
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
            [['like_status', 'is_hidden', 'is_downloaded'], 'string'],
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
            'like_status' => 'Like Status',
            'is_hidden' => 'Is Hidden',
            'is_downloaded' => 'Is Downloaded',
        ];
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
}
