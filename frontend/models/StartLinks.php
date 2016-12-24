<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "start_links".
 *
 * @property integer $start_link_id
 * @property string $url
 * @property string $tittle
 *
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
            [['url', 'tittle'], 'required'],
            [['url'], 'string', 'max' => 255],
            [['tittle'], 'string', 'max' => 45],
        ];
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
        ];
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
        $name = preg_replace("/[^A-Za-z]/", "", $this->tittle);
        return $name;
    }

}
