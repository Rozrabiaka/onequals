<?php
$this->title = 'OnEquals - ' . $title;
?>

<div class="container signup-success">
    <div class="row">
        <div class="col-lg-12 signup-success-info">
            <img src="/images/lightnings.png">
            <?php if (!empty($error)): ?>
                <h3>Помилка</h3>
            <?php else: ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>