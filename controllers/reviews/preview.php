<?php Block::put('breadcrumb') ?>
    <ul>
        <li><a href="<?= Backend::url('hounddd/reviews/reviews') ?>"><?= e(trans('hounddd.reviews::lang.models.review.label_plural')); ?></a></li>
        <li><?= e($this->pageTitle) ?></li>
    </ul>
<?php Block::endPut() ?>

<?php if (!$this->fatalError): ?>

    <?php Block::put('form-contents') ?>

        <div class="layout-row min-size">
            <?= $this->formRender(['preview' => true, 'section' => 'outside']) ?>
        </div>

        <div class="layout-row">
            <?= $this->formRender(['preview' => true, 'section' => 'primary']) ?>
        </div>

    <?php Block::endPut() ?>

    <?php Block::put('form-sidebar') ?>
        <div class="hide-tabs"><?= $this->formRender(['preview' => true, 'section' => 'secondary']) ?></div>
    <?php Block::endPut() ?>

    <?php Block::put('body') ?>
        <?= Form::open(['class'=>'layout stretch']) ?>
            <?= $this->makeLayout('form-with-sidebar') ?>
        <?= Form::close() ?>
    <?php Block::endPut() ?>

<?php else: ?>

    <p class="flash-message static error"><?= e($this->fatalError) ?></p>
    <p><a href="<?= Backend::url('hounddd/reviews/reviews') ?>" class="btn btn-default"><?= e(trans('backend::lang.form.return_to_list')); ?></a></p>

<?php endif ?>
