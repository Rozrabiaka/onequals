<?php

  if (!empty($model['company_name'])) $this->title = 'OnEquals - ' . $model['company_name'];
  else $this->title = 'OnEquals - ' . $model['firstname'] . ' ' . $model['lastname'];

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
                        <?php if (!empty($model['company_name'])): ?>
                            <h1 class="company-name"><?php echo $model['company_name']; ?></h1>
                        <?php else: ?>
                            <h1 class="company-name"><?php echo $model['firstname'] . ' ' . $model['lastname']; ?></h1>
                        <?php endif; ?>
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
                    <?php if (!empty($model['company_description'])): ?>
                        <p><?php echo $model['company_description'] ?></p>
                    <?php else: ?>
                        <p><?php echo $model['description'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($info)): ?>
        <div class="profile-vacancies">
            <div class="container">
                <?php foreach ($info as $vac): ?>
                    <div class="row vacancies-info">
                        <div class="col-xl-4 vac-info-block">
                            <p class="spec_name"><?php echo $vac['spec_name'] ?></p>
                            <p class="emp_name"><?php echo $vac['emp_name'] ?></p>
                            <p class="locality"><?php echo $vac['title'] . ', ' . $vac['type'] ?></p>
                            <p class="wage"><?php echo $vac['wage'] ?></p>
                            <div class="profile-des-hide">
                                <span id="<?php echo $vac['id'] ?>"
                                      class="description description-<?php echo $vac['id'] ?>"><?php echo $vac['description'] ?></span>
                                <span id="<?php echo $vac['id'] ?>"
                                      class="profile-roll-down profile-roll-down-<?php echo $vac['id'] ?>">розгорнути ↓</span>
                                <span id="<?php echo $vac['id'] ?>"
                                      class="profile-roll-up profile-roll-up-<?php echo $vac['id'] ?>">згорнути ↑</span>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="em-profile-buttons-vacancies">
                                <?php if (!Yii::$app->user->isGuest): ?>
                                    <?php if (in_array($vac['id'], $likeModel)): ?>
                                        <a href="/site/remove-like?id=<?php echo $vac['id'] ?>">
                                            <div class="vac-prof-but vac-prof-but-heart vac-prof-button-search vac-prof-but-heart-remove-like">
                                                <img src="/images/heart-vacancy.png">
                                            </div>
                                        </a>
                                    <?php else: ?>
                                        <a href="/site/add-like?id=<?php echo $vac['id'] ?>">
                                            <div class="vac-prof-but vac-prof-but-heart vac-prof-button-search ">
                                                <img src="/images/heart-vacancy.png">
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <a href="mailto::<?php echo $model['email'] ?>">
                                    <div class="vac-prof-but vac-prof-but-email vac-prof-button-search">
                                        <img src="/images/mail-vacancy.png">
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
</div>
