<?php

/* @var $this yii\web\View */

$this->title = 'OnEquals - Профіль шукача';
?>
<div class="worker-profile">
    <div class="profile-head">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 employer-avatar ">
                    <img src="<?php echo $model['img'] ?>">
                </div>
                <div class="col-xl-9 profile-top-info">
                    <div class="employer-header-info">
                        <h1 class="company-name"><?php echo $model['firstname'] . ' ' . $model['lastname']; ?></h1>
                        <p class="profile-webpage"><?php echo $model['webpage'] ?></p>
                        <p>
                            <img src="/images/location.png"/><span><?php echo $model['title'] . ', ' . $model['type'] ?></span>
                        </p>
                    </div>

                    <div class="social">
                        <?php if (!empty($model['facebook'])): ?>
                            <div class="col-xl-3 links">
                                <a target="_blank" href="<?php echo $model['facebook']; ?>"><img
                                            src="/images/facebook-f.png"/> </a>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($model['instagram'])): ?>
                            <div class="col-xl-3 links">
                                <a target="_blank" href="<?php echo $model['instagram']; ?>"><img
                                            src="/images/instagram.png"/> </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($model['twitter'])): ?>
                            <div class="col-xl-3 links">
                                <a target="_blank" href="<?php echo $model['twitter']; ?>"><img
                                            src="/images/twitter.png"/> </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($model['LinkedIn'])): ?>
                            <div class="col-xl-3 links">
                                <a target="_blank" href="<?php echo $model['LinkedIn']; ?>"><img
                                            src="/images/linkedin-in.png"/> </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-about">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <p><?php echo $model['description'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($summary)): ?>
        <div class="profile-vacancies">
            <div class="container">
                <?php foreach ($summary as $sum): ?>
                    <div class="row vacancies-info">
                        <div class="col-xl-4 vac-info-block">
                            <p class="spec_name"><?php echo $sum['spec_name'] ?></p>
                            <p class="emp_name"><?php echo $sum['emp_name'] ?></p>
                            <p class="locality"><?php echo $sum['title'] . ', ' . $sum['type'] ?></p>
                            <p class="wage"><?php echo $sum['wage'] ?></p>
                            <div class="worker-des-hide">
                                <span id="<?php echo $sum['id'] ?>"
                                      class="description description-<?php echo $sum['id'] ?>"><?php echo $sum['description'] ?></span>
                                <span id="<?php echo $sum['id'] ?>"
                                      class="worker-roll-down worker-roll-down-<?php echo $sum['id'] ?>">розгорнути ↓</span>
                                <span id="<?php echo $sum['id'] ?>"
                                      class="worker-roll-up worker-roll-up-<?php echo $sum['id'] ?>">згорнути ↑</span>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="em-profile-buttons-vacancies">
                                <a href="/site/worker-summary-edit?id=<?php echo $sum['id'] ?>">
                                    <div class="vac-prof-but">
                                        <img src="/images/edit-vacancy.png"/>
                                    </div>
                                </a>
                                <a class="a-em-prof-but-delete"
                                   href="/site/worker-summary-delete?id=<?php echo $sum['id'] ?>">
                                    <div class="vac-prof-but delete">
                                        <img src="/images/trash-vacancy.png"/>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>

    <?php endif; ?>

    <div class="employer-buttons">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="div-button-a div-button-border employer-paddings-button">
                        <a class="button" href="/site/worker-summary">Додати ще резюме +</a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="div-button-a employer-button-hide employer-paddings-button">
                        <a class="button" href="/site/hide-worker">
                            <?php if ($model['hide_worker'] == 0): ?>
                                Приховати сторінку
                            <?php else: ?>
                                Показати сторінку
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="div-button-a div-button-border employer-paddings-button">
                        <a class="button" href="/site/edit-worker">Редагувати інформацію</a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="div-button-a employer-remove-button employer-paddings-button">
                        <a class="button" href="/site/delete-worker">Видалити акаунт</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="liked-vacancies vacancies-info">
        <div class="container">
            <h1>Збережені резюме:</h1>
            <?php if (!empty($vacancies)): ?>
                <?php foreach ($vacancies as $value): ?>
                    <div class="row">
                        <div class="col-xl-7 vac-info-block profile-info-block">

                            <h3 class="vac-info-search-h3"><?php echo $value['company_name'] ?></h3>

                            <p class="spec_name"><?php echo $value['spec_name'] ?></p>
                            <p class="emp_name"><?php echo $value['emp_name'] ?></p>
                            <p class="locality"><?php echo $value['title'] . ', ' . $value['type'] ?></p>
                            <p class="wage"><?php echo $value['wage'] ?></p>
                            <div class="search-des-hide">
                    <span id="<?php echo $value['id'] ?>"
                          class="description description-<?php echo $value['id'] ?>"><?php echo $value['description'] ?></span>
                                <span id="<?php echo $value['id'] ?>"
                                      class="vacancies-info-search-roll-down vacancies-info-search-roll-down-<?php echo $value['id'] ?>">розгорнути ↓</span>
                                <span id="<?php echo $value['id'] ?>"
                                      class="vacancies-info-search-roll-up vacancies-info-search-roll-up-<?php echo $value['id'] ?>">згорнути ↑</span>
                            </div>
                        </div>
                        <div class="col-xl-5 em-profile-buttons-vacancies">
                            <a href="/site/profile?id=<?php echo $value['user_id'] ?>">
                                <div class="vac-prof-but vac-prof-button-search">
                                    <img src="/images/eye-vacancy.png">
                                </div>
                            </a>

                            <?php if (!Yii::$app->user->isGuest): ?>
                                <?php if (in_array($value['id'], $likeModel)): ?>
                                    <a href="/site/remove-like?id=<?php echo $value['id'] ?>">
                                        <div class="vac-prof-but vac-prof-but-heart vac-prof-button-search vac-prof-but-heart-remove-like">
                                            <img src="/images/heart-vacancy.png">
                                        </div>
                                    </a>
                                <?php else: ?>
                                    <a href="/site/add-like?id=<?php echo $value['id'] ?>">
                                        <div class="vac-prof-but vac-prof-but-heart vac-prof-button-search ">
                                            <img src="/images/heart-vacancy.png">
                                        </div>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <a href="mailto::<?php echo $value['email']; ?>">
                                <div class="vac-prof-but vac-prof-but-email vac-prof-button-search">
                                    <img src="/images/mail-vacancy.png">
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
