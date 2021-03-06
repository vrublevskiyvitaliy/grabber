<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "start_links".
 *
 * @property integer $start_link_id
 * @property string $url
 * @property string $tittle
 * @property integer $site_id
 * @property integer $search_depth
 * @property string $is_active
 *
 * @property Site $site
 * @property VideoPage[] $videoPages
 */
class StartLinks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'start_links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'tittle', 'site_id'], 'required'],
            [['site_id', 'search_depth'], 'integer'],
            [['is_active'], 'in', 'range' => ['yes', 'no']],
            [['url'], 'string', 'max' => 255],
            [['tittle'], 'string', 'max' => 45],
            [['site_id'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['site_id' => 'site_id']],
        ];
    }

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);

        // create directory for downloads
        $path = Yii::$app->params['downloadFolder'] . $this->getFolderName();
        shell_exec(' mkdir ' . $path);

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'start_link_id' => 'Start Link ID',
            'url' => 'Url',
            'tittle' => 'Tittle',
            'site_id' => 'Site ID',
            'search_depth' => 'Search Depth',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['site_id' => 'site_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoPages()
    {
        return $this->hasMany(VideoPage::className(), ['start_link_id' => 'start_link_id']);
    }

    public function getFolderName()
    {
        $name = (string)$this->start_link_id;
        return $name;
    }
}
