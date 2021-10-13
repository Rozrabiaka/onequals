<?php

use yii\widgets\ListView;

$this->title = 'OnEquals - Список резюме';
?>

<div class="search-block">
    <div class="container">
        <div class="row">
            <?php echo \common\widgets\SearchWidget::widget(); ?>
        </div>
    </div>
</div>
<div class="list-view-search-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 order-2 order-sm-2 order-md-2 order-lg-2 order-xl-1">
                <div class="sorter-lvsp">
                    <div class="summary-sorter-lvsp">
                        <p class="sorter-info-text">Всього: </p>
                        <?
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'layout' => "{summary}",
                            'summary' => '{totalCount} вакансій',
                            'options' => [
                                'class' => 'summary-list',
                            ],
                            'emptyText' => 'Результатів не знайдено'
                        ]);
                        ?>
                    </div>

                    <div class="sorter-lvsp-list">
                        <p class="sorter-info-text">Сортувати: </p>
                        <?php
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'layout' => "{sorter}",
                            'sorter' => [

                            ],
                            'options' => [
                                'class' => 'sorter-list',
                            ],
                            'emptyText' => 'Результатів не знайдено'
                        ]);
                        ?>
                    </div>

                </div>
                <?php echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_viewSearch',
                    'viewParams' => ['likeModel' => $likeModel],
                    'layout' => "{items}\n{pager}",
                    'emptyText' => false,
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
                ])
                ?>
            </div>

            <div class="col-xl-4 order-1 order-sm-1 order-md-1 order-lg-1 order-xl-2">
                <div class="cat-list">
                    <h3 class="list-search-h3">Категорія:</h3>
                    <?php foreach ($specializations as $key => $spec): ?>
                        <input class="list-checkbox cart-list-checkbox cart-list-checkbox-<?php echo $key; ?>"
                               type="checkbox"
                               id="cart-<?php echo $key ?>"
                               value="<?php echo $key ?>"
                               <?php if (in_array($key, $listArray)): ?>checked<?php endif; ?>>
                        <label for="cart-<?php echo $key; ?>"><?php echo $spec; ?></label>
                    <?php endforeach; ?>
                </div>

                <div class="type-list">
                    <h3 class="list-search-h3">Вид зайнятості:</h3>
                    <?php foreach ($employerType as $key => $empType): ?>
                        <input class="list-checkbox type-list-checkbox type-list-checkbox-<?php echo $key; ?>"
                               type="checkbox"
                               id="type-<?php echo $key ?>"
                               value="<?php echo $key ?>"
                               <?php if (in_array($key, $typeArray)): ?>checked<?php endif; ?>>
                        <label for="type-<?php echo $key; ?>"><?php echo $empType; ?></label>
                    <?php endforeach; ?>
                </div>

                <div class="price-list">
                    <h3 class="list-search-h3">Зарплата:</h3>
                    <div id="slider-container-search-price"></div>
                    <div class="pl-jq-list">
                        <div class="pl-jq-price-from pl-jq-price-filter">
                            <p style="color:#999">Від:</p>
                            <p id="from"></p>
                        </div>
                        <div class="pl-jq-price-to pl-jq-price-filter">
                            <p style="color:#999">До:</p>
                            <p id="to"></p>
                        </div>

                        <input type="hidden" class="search-max-price" value="<?php echo $maxPrice; ?>"/>
                    </div>
                    <div id="slider-range"></div>
                </div>
            </div>
        </div>
    </div>
</div>
