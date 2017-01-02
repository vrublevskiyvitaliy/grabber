<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "actor".
 *
 * @property integer $actor_id
 * @property string $actor_name
 *
 * @property ActorToVideoPage[] $actorToVideoPages
 */
class Actor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actor_name'], 'required'],
            [['actor_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'actor_id' => 'Actor ID',
            'actor_name' => 'Actor Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActorToVideoPages()
    {
        return $this->hasMany(ActorToVideoPage::className(), ['actor_id' => 'actor_id']);
    }
}
