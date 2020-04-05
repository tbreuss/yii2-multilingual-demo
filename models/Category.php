<?php

namespace app\models;

use Yii;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    use MultilingualLabelsTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    public function behaviors()
    {
        return [
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'languages' => [
                    'de' => 'Deutsch',
                    'fr' => 'Français',
                    #'it' => 'Italiano',
                    #'en' => 'English'
                ],
                'attributes' => [
                    'title',
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 127],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['created_at'], 'default', 'value' => date('Y-m-d H:i:s'), 'on'=>'insert'],
            [['updated_at'], 'default', 'value' => date('Y-m-d H:i:s'), 'on'=>'update'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public static function dropDownList()
    {
        $categories = static::find()->all();
        return ArrayHelper::map($categories, 'id', 'name');
    }
    public function fields()
    {
        return [
            'id',
            'name',
            #'title',
            'created_at',
            'updated_at'
        ];
    }
}
