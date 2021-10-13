<?php
$this->title = 'OnEquals - Мій профіль';
?>

<div class="employer-profile">
    <div class="profile-head">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 employer-avatar ">
                    <img src="<?php echo $model['img'] ?>">
                </div>
                <div class="col-xl-9 profile-top-info">
                    <div class="employer-header-info">
                        <h1 class="company-name"><?php echo $model['company_name']; ?></h1>
                        <p class="profile-webpage"><?php echo $model['webpage'] ?></p>
                        <p>
                            <img src="/images/location.png"/><span><?php echo $model['title'] . ', ' . $model['type'] ?></span>
                        </p>
                    </div>

                    <div class="social">
                        <?php if(!empty($model['facebook'])): ?>
                            <div class="col-xl-3 links">
                                <a target="_blank" href="<?php echo $model['facebook']; ?>"><img src="/images/facebook-f.png" /> </a>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($model['instagram'])): ?>
                            <div class="col-xl-3 links">
                                <a target="_blank" href="<?php echo $model['instagram']; ?>"><img src="/images/instagram.png" /> </a>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($model['twitter'])): ?>
                            <div class="col-xl-3 links">
                                <a target="_blank" href="<?php echo $model['twitter']; ?>"><img src="/images/twitter.png" /> </a>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($model['LinkedIn'])): ?>
                            <div class="col-xl-3 links">
                                <a target="_blank" href="<?php echo $model['LinkedIn']; ?>"><img src="/images/linkedin-in.png" /> </a>
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
                    <p><?php echo $model['company_description'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($vacancies)): ?>
        <div class="profile-vacancies">
            <div class="container">
                    <?php foreach ($vacancies as $vac): ?>
                    <div class="row vacancies-info">
                        <div class="col-xl-4 vac-info-block">
                            <p class="spec_name"><?php echo $vac['spec_name'] ?></p>
                            <p class="emp_name"><?php echo $vac['emp_name'] ?></p>
                            <p class="locality"><?php echo $vac['title'] . ', ' . $vac['type'] ?></p>
                            <p class="wage"><?php echo $vac['wage'] ?></p>
                            <div class="employer-des-hide">
                                <span id="<?php echo $vac['id'] ?>" class="description description-<?php echo $vac['id'] ?>"><?php echo $vac['description'] ?></span>
                                <span id="<?php echo $vac['id'] ?>" class="employer-roll-down employer-roll-down-<?php echo $vac['id'] ?>">розгорнути ↓</span>
                                <span id="<?php echo $vac['id'] ?>" class="employer-roll-up employer-roll-up-<?php echo $vac['id'] ?>">згорнути ↑</span>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="em-profile-buttons-vacancies">
                                <a href="/site/vacancies-employer-edit?id=<?php echo $vac['id'] ?>">
                                    <div class="vac-prof-but">
                                        <img src="/images/edit-vacancy.png" />
                                    </div>
                                </a>
                                <a class="a-em-prof-but-delete" href="/site/vacancies-employer-delete?id=<?php echo $vac['id'] ?>">
                                    <div class="vac-prof-but delete">
                                        <img src="/images/trash-vacancy.png" />
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
                        <a class="button" href="/site/employer-vacation">Додати ще вакансію +</a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="div-button-a employer-button-hide employer-paddings-button">
                        <a class="button" href="/site/hide-employer">
                            <?php if ($model['hide_employer'] == 0): ?>
                                Приховати сторінку
                            <?php else: ?>
                                Показати сторінку
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="div-button-a div-button-border employer-paddings-button">
                        <a class="button" href="/site/edit-employer">Редагувати інформацію</a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="div-button-a employer-remove-button employer-paddings-button">
                        <a class="button" href="/site/delete-employer">Видалити акаунт</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="liked-vacancies vacancies-info">
        <div class="container">
            <h1>Збережені резюме:</h1>
            <?php if (!empty($summary)): ?>
                <?php foreach ($summary as $value): ?>
                    <div class="row">
                        <div class="col-xl-7 vac-info-block profile-info-block">

                            <h3 class="vac-info-search-h3"><?php echo $value['lastname'] . ' ' . $value['firstname'] ?></h3>

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