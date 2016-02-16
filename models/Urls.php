<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "urls".
 *
 * @property integer $id
 * @property string $locator
 */
class Urls extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'urls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['locator'], 'required'],
            [['locator'], 'string', 'max' => 2083]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'locator' => 'Locator',
        ];
    }
}
