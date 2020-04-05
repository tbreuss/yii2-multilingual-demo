<?php

namespace app\models;

use Yii;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\db\MultilingualQuery;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class News extends \yii\db\ActiveRecord
{
    use MultilingualLabelsTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
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
                    'title', 'content',
                ]
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['date'], 'required'],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['content'], 'string'],
            [['created_at'], 'default', 'value' => date('Y-m-d H:i:s'), 'on'=>'insert'],
            [['updated_at'], 'default', 'value' => date('Y-m-d H:i:s'), 'on'=>'update']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function fields()
    {
        return [
            'id',
            'date',
            'title',
            'category',
            'content',
            'created_at',
            'updated_at',
            'published_at'
        ];
    }
}
