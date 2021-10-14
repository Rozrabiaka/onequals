<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_employer".
 *
 * @property int $id
 * @property string $description
 * @property string $author_name
 * @property string $page_name
 * @property string $blog_category
 * @property string $second_blog_category
 */
class BlogEmployer extends \yii\db\ActiveRecord
{
    public $blog_category;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_employer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'page_name', 'second_blog_category'], 'required'],
            [['description'], 'string'],
            [['author_name', 'page_name', 'second_blog_category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'author_name' => 'Author Name',
            'page_name' => 'Page Name',
            'second_blog_category' => 'Second Blog Category',
        ];
    }
}
