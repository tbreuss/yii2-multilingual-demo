<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "File".
 *
 * @property int $id
 * @property string $uuid
 * @property string $mime_type
 * @property string $filename
 * @property string $content
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'File';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uuid', 'mime_type', 'filename', 'content'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['mime_type'], 'string', 'max' => 31],
            [['filename'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'UUID',
            'mime_type' => 'Mime Type',
            'filename' => 'Filename',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
