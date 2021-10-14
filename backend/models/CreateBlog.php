<?php

namespace backend\models;

use yii\base\Model;

/**
 * Signup form
 */
class CreateBlog extends Model
{
    public $description;
    public $author_name;
    public $page_name;
    public $blog_category;
    public $second_blog_category;

    const BLOG_CATEGORY_SUMMARY = 0;
    const BLOG_CATEGORY_EMPLOYER = 1;
    const BLOG_CATEGORY_LEGISLATION = 2;

    const SECOND_BLOG_CATEGORY_ADVICES = 0;
    const SECOND_BLOG_CATEGORY_ACCESSIBILITY = 1;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'page_name', 'blog_category', 'second_blog_category'], 'required'],
            [['description'], 'string'],
            [['author_name', 'page_name', 'blog_category', 'second_blog_category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Текст блогу',
            'author_name' => "Ім'я автора",
            'page_name' => 'Титулка сторінки',
            'blog_category' => 'Категорія',
            'second_blog_category' => 'Порада / Доступність',
        ];
    }

    public function getBlogCategory()
    {
        return array(
            self::BLOG_CATEGORY_SUMMARY => 'Шукачам',
            self::BLOG_CATEGORY_EMPLOYER => 'Роботодавцям',
            self::BLOG_CATEGORY_LEGISLATION => 'Законодавство'
        );
    }

    public function getSecondBlogCategory()
    {
        return array(
            self::SECOND_BLOG_CATEGORY_ADVICES => 'Поради',
            self::SECOND_BLOG_CATEGORY_ACCESSIBILITY => 'Доступність'
        );
    }
}
