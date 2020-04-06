<?php

namespace app\models;

use Ramsey\Uuid\Uuid;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "File".
 *
 * @property int $id
 * @property string $uuid
 * @property string $mime_type
 * @property int $size
 * @property string $filename
 * @property string $content
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $uploadedFile;

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
            [['uploadedFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif, pdf'],
            // uuid
            ['uuid', 'required'],
            ['uuid', 'string', 'max' => 36],
            // mime_type
            ['mime_type', 'required'],
            ['mime_type', 'string', 'max' => 31],
            // filename
            ['filename', 'required'],
            ['filename', 'string', 'max' => 255],
            // content
            ['content', 'required'],
            ['content', 'string'],
            // ...
            [['created_at'], 'default', 'value' => date('Y-m-d H:i:s'), 'on'=>'insert'],
            [['updated_at'], 'default', 'value' => date('Y-m-d H:i:s'), 'on'=>'update'],
            [['deleted_at'], 'safe'],
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

    public static function createFromUploadFile(UploadedFile $uploadedFile)
    {
        $model = new self();
        $model->uploadedFile = $uploadedFile;
        $model->uuid = Uuid::uuid4()->toString();
        $model->mime_type = $uploadedFile->type;
        $model->size = $uploadedFile->size;
        $model->filename = $uploadedFile->getBaseName();
        if (is_uploaded_file($uploadedFile->tempName)) {
            $model->content = base64_encode(file_get_contents($uploadedFile->tempName));
        }
        return $model;
    }

    public function getAbsUrl(string $type)
    {
        return Url::base(true) . '/index.php/download/' . $type . '?uuid=' . $this->uuid;
    }
}
