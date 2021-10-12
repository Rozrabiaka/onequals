<?php

?>

<div class="vacancies-info search-vacancies-info">
    <div class="vac-info-block">
        <div class="row">
            <div class="col-xl-7 vac-info-block">
                <?php if (!empty($model->relatedRecords['employer'])): ?>
                    <h3 class="vac-info-search-h3"><?php echo $model->relatedRecords['employer']->company_name ?></h3>
                <?php else: ?>
                    <h3 class="vac-info-search-h3"><?php echo $model->relatedRecords['worker']->lastname . ' ' . $model->relatedRecords['worker']->firstname ?></h3>
                <? endif; ?>

                <p class="spec_name"><?php echo $model->relatedRecords['specializations']->name ?></p>
                <p class="emp_name"><?php echo $model->relatedRecords['employerType']->name ?></p>
                <p class="locality"><?php echo $model->relatedRecords['country']->title . ', ' . $model->relatedRecords['country']->type ?></p>
                <p class="wage"><?php echo $model->wage ?></p>
                <div class="search-des-hide">
                    <span id="<?php echo $model->id ?>"
                          class="description description-<?php echo $model->id ?>"><?php echo $model->description ?></span>
                    <span id="<?php echo $model->id ?>"
                          class="search-roll-down search-roll-down-<?php echo $model->id ?>">розгорнути ↓</span>
                    <span id="<?php echo $model->id ?>" class="search-roll-up search-roll-up-<?php echo $model->id ?>">згорнути ↑</span>
                </div>
            </div>
            <div class="col-xl-5 em-profile-buttons-vacancies">
                <a href="/site/profile?id=<?php echo $model->relatedRecords['user']->relatedRecords['user']->id ?>">
                    <div class="vac-prof-but vac-prof-button-search">
                        <img src="/images/eye-vacancy.png">
                    </div>
                </a>

                <?php if (!Yii::$app->user->isGuest): ?>
                    <?php if (in_array($model->id, $likeModel)): ?>
                        <a href="/site/remove-like?id=<?php echo $model->id ?>">
                            <div class="vac-prof-but vac-prof-but-heart vac-prof-button-search vac-prof-but-heart-remove-like">
                                <img src="/images/heart-vacancy.png">
                            </div>
                        </a>
                    <?php else: ?>
                        <a href="/site/add-like?id=<?php echo $model->id ?>">
                            <div class="vac-prof-but vac-prof-but-heart vac-prof-button-search ">
                                <img src="/images/heart-vacancy.png">
                            </div>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>

                <a href="mailto::<?php echo $model->relatedRecords['user']->relatedRecords['user']->email; ?>">
                    <div class="vac-prof-but vac-prof-but-email vac-prof-button-search">
                        <img src="/images/mail-vacancy.png">
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
