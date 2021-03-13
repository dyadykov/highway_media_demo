<?php


namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class Product
 *
 * @property integer $id
 * @property string $title название
 * @property string $description описание
 *
 * @package common\models
 */
class WonderfulItem extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%wonderful_item}}';
    }

    public function rules()
    {
        return [
            ['id', 'integer'],
            [['title', 'description'], 'string',  'message' => '{attribute} должен быть строкой.'],
            [['title', 'description'], 'required',  'message' => '{attribute} не может быть пустым.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
        ];
    }
}
