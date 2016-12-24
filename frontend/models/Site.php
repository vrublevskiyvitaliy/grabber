<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "site".
 *
 * @property integer $site_id
 * @property string $url
 * @property string $parser_name
 *
 * @property StartLinks[] $startLinks
 */
class Site extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'parser_name'], 'required'],
            [['url', 'parser_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'site_id' => 'Site ID',
            'url' => 'Url',
            'parser_name' => 'Parser Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartLinks()
    {
        return $this->hasMany(StartLinks::className(), ['site_id' => 'site_id']);
    }
}
