<?php

use yii\widgets\ListView;

$this->title = 'OnEquals - Блог шукачам';
?>

<div class="blog-header" style="background-color: #C4DE95">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="blog-image-small blog-summary-star-small" src="/images/blog-star-summary.png" alt="">
                <div class="blog-header-text">
                    <h1 class="info-header-title">Журнал</h1>
                    <div class="info-header-text">Шукачам</div>
                </div>
            </div>
            <div class="col-md-8 right-image">
                <img class="blog-image blog-summary-star" src="/images/blog-star-summary.png" alt="">
                <img class="blog-image blog-summary-pic" src="/images/blog-summary.png" alt="">
            </div>
        </div>
    </div>
</div>
<div class="stories">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <h2 class="info-header-title">Історії</h2>
            </div>

            <div class="swiper-container swiper-block blog-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($modelHistory as $history): ?>
                        <div class="index-swiper swiper-slide second">
                            <div class="col-xl-5 swiper-img">
                                <img src="<?php echo $history->img; ?>"/>
                            </div>
                            <div class="col-xl-7 swiper-text">
                                <?php echo $history->description ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row swiper-blog">
                    <div class="swiper-button-prev col-md-6 swiper-blog-button">
                        <div class="prev-blog"><span>←</span></div>
                    </div>
                    <div class="swiper-button-next col-md-6 swiper-blog-button swiper-blog-button-next-blog">
                        <div class="next-blog">
                            Наступна історія →
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="accessibility-blog">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h2 class="info-header-title">Доступність</h2>
            </div>
        </div>
        <?php echo ListView::widget([
            'dataProvider' => $dataProviderSummaryAccessibility,
            'itemView' => '_blog',
            'layout' => "{items}",
            'emptyText' => false,
            'itemOptions' => ['class' => "col-xl-4 list-view-advices-blocks"],
            'options' => ['class' => 'row list-view-advices'],
        ])
        ?>

        <div class="row">
            <div class="col-xl-12">
                <?php echo ListView::widget([
                    'dataProvider' => $dataProviderSummaryAccessibility,
                    'layout' => "{pager}",
                    'emptyText' => false,
                    'options' => ['class' => 'row list-view-advices-pager'],
                    'pager' => [
                        'prevPageLabel' => '
                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                        ',
                        'nextPageLabel' => '
                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                        ',
                        'maxButtonCount' => 10,
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>

<div class="summary-advices-blog">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h2 class="info-header-title">Поради</h2>
            </div>
        </div>
        <?php echo ListView::widget([
            'dataProvider' => $dataProviderSummaryAdvices,
            'itemView' => '_blog',
            'layout' => "{items}",
            'emptyText' => false,
            'itemOptions' => ['class' => "col-xl-4 list-view-advices-blocks"],
            'options' => ['class' => 'row list-view-advices'],
        ])
        ?>

        <div class="row">
            <div class="col-xl-12">
                <?php echo ListView::widget([
                    'dataProvider' => $dataProviderSummaryAdvices,
                    'layout' => "{pager}",
                    'options' => ['class' => 'row list-view-advices-pager'],
                    'pager' => [
                        'prevPageLabel' => '
                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                        ',
                        'nextPageLabel' => '
                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                        ',
                        'maxButtonCount' => 10,
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>