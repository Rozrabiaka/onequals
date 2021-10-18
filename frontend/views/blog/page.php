<?php

$this->title = 'OnEquals - ' . $model->page_name;

?>

<div class="blog-page">
    <div class="container">
        <div class="row">

            <div class="col-xl-12 blog-page-category">
                <span class="blog-page-category-name"><?php echo $categoryName ?></span>
            </div>

            <div class="col-xl-12 blog-page-title">
                <h1 class="blog-page-title-text"><?php echo $model->page_name ?></h1>
            </div>

            <div class="col-xl-12 blog-page-text">
                <?php echo $model->description ?>
            </div>

            <?php if (!empty($model->author_name)): ?>
                <div class="col-xl-12 blog-page-author">
                    <span class="blog-page-author-name">Автор(ка): <?php echo $model->author_name ?></span>
                </div>
            <?php endif; ?>
        </div>
        <div class="row swiper-blog">
            <div class="blog-swiper-button-prev col-md-6 swiper-blog-button">
                <a href="<?php echo $prevPageUrl ?>">
                    <div class="prev-blog"><span>←</span></div>
                </a>
            </div>
            <div class="blog-swiper-button-next col-md-6 swiper-blog-button swiper-blog-button-next-blog">
                <a href="<?php echo $nextPageUrl ?>">
                    <div class="next-blog">
                        Наступна стаття →
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="blog-read-more">
    <div class="container">
        <div class="row">
            <?php foreach ($readMoreBlogs as $value): ?>
                <div class="col-xl-4">
                    <a href="/blog/page/?id=<?php echo $value->id ?>">
                        <div class="read-more-list-view">
                            <div class="category-name">
                                <span style="background-color:<?php echo $model->getRandomColor() ?>;"><?php echo $model->getCategoryName($value->blog_category) ?></span>
                            </div>
                            <div class="title">
                                <?php echo $value->page_name ?>
                            </div>
                            <div class="text">
                                <?php echo $value->description ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
