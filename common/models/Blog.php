<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "blog_summary".
 *
 * @property int $id
 * @property string $description
 * @property string $author_name
 * @property string $page_name
 * @property string $blog_category
 * @property string $second_blog_category
 */
class Blog extends \yii\db\ActiveRecord
{
    const COLORS = array('#C4DE95', '#FDD749', '#509FC8', '#F98DC0');

    const BLOG_CATEGORY_SUMMARY = 0;
    const BLOG_CATEGORY_EMPLOYER = 1;
    const BLOG_CATEGORY_LEGISLATION = 2;

    const SECOND_BLOG_CATEGORY_ADVICES = 0;
    const SECOND_BLOG_CATEGORY_ACCESSIBILITY = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

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
            'description' => 'Description',
            'author_name' => 'Author Name',
            'page_name' => 'Page Name',
            'blog_category' => 'Blog Category',
            'second_blog_category' => 'Second Blog Category',
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

    public function getNextBlogUrl($postId)
    {
        $model = self::findOne($postId);
        if (!empty($model)) {
            $modelResult = $model->find()->where(['>', 'id', $postId])->one();
            if (!empty($modelResult))
                return Url::toRoute(['/blog/page', 'id' => $modelResult->id]);
        }

        return null;
    }

    public function getPrevBlogUrl($postId)
    {
        $model = self::findOne($postId);
        if (!empty($model)) {
            $modelResult = $model->find()->where(['<', 'id', $postId])->orderBy('id desc')->one();
            if (!empty($modelResult))
                return Url::toRoute(['/blog/page', 'id' => $modelResult->id]);
        }

        return null;
    }

    public function getReadMoreBlogs($id)
    {
        return self::find()->where(['!=', 'id', $id])->orderBy('RAND()')->limit(6)->all();
    }

    public function getCategoryName($id)
    {
        $categoryName = null;
        switch ($id) {
            case self::BLOG_CATEGORY_SUMMARY:
                $categoryName = 'Шукачам';
                break;
            case self::BLOG_CATEGORY_EMPLOYER:
                $categoryName = 'Роботодавцям';
                break;
            case self::BLOG_CATEGORY_LEGISLATION:
                $categoryName = 'Законодавство';
                break;
        }

        return $categoryName;
    }

    public function getRandomColor()
    {
        $r = array_rand(self::COLORS);
        return self::COLORS[$r];
    }
}
