<?php Block::put('breadcrumb') ?>
    <ul>
        <li><a href="<?= Backend::url('hounddd/reviews/reviews') ?>">Reviews</a></li>
        <li><?= e($this->pageTitle) ?></li>
    </ul>
<?php Block::endPut() ?>

<?php if (!$this->fatalError): ?>

    <?php Block::put('form-contents') ?>

        <div class="layout-row min-size">
            <?= $this->formRenderOutsideFields() ?>
        </div>

        <div class="layout-row">
            <?= $this->formRenderPrimaryTabs() ?>
        </div>

        <div class="form-buttons">
            <div class="loading-indicator-container">
                <button
                    type="button"
                    data-request="onSave"
                    data-request-data="redirect:0"
                    data-hotkey="ctrl+s, cmd+s"
                    data-load-indicator="<?= e(trans('backend::lang.form.saving_name', ['name' => trans('hounddd.reviews::lang.models.review.label')])); ?>"
                    class="btn btn-primary">
                    <?= e(trans('backend::lang.form.save')); ?>
                </button>
                <button
                    type="button"
                    data-request="onSave"
                    data-request-data="close:1"
                    data-hotkey="ctrl+enter, cmd+enter"
                    data-load-indicator="<?= e(trans('backend::lang.form.saving_name', ['name' => trans('hounddd.reviews::lang.models.review.label')])); ?>"
                    class="btn btn-default">
                    <?= e(trans('backend::lang.form.save_and_close')); ?>
                </button>
                <button
                    type="button"
                    class="wn-icon-trash-o btn-icon danger pull-right"
                    data-request="onDelete"
                    data-load-indicator="<?= e(trans('backend::lang.form.deleting_name', ['name' => trans('hounddd.reviews::lang.models.review.label')])); ?>"
                    data-request-confirm="<?= e(trans('backend::lang.form.confirm_delete')); ?>">
                </button>
                <span class="btn-text">
                    or <a href="<?= Backend::url('hounddd/reviews/reviews') ?>"><?= e(trans('backend::lang.form.cancel')); ?></a>
                </span>
            </div>
        </div>

    <?php Block::endPut() ?>

    <?php Block::put('form-sidebar') ?>
        <div class="hide-tabs"><?= $this->formRenderSecondaryTabs() ?></div>
    <?php Block::endPut() ?>

    <?php Block::put('body') ?>
        <?= Form::open(['class'=>'layout stretch']) ?>
            <?= $this->makeLayout('form-with-sidebar') ?>
        <?= Form::close() ?>
    <?php Block::endPut() ?>

<?php else: ?>

    <div class="control-breadcrumb">
        <?= Block::placeholder('breadcrumb') ?>
    </div>
    <div class="padded-container">
        <p class="flash-message static error"><?= e($this->fatalError) ?></p>
        <p><a href="<?= Backend::url('hounddd/reviews/reviews') ?>" class="btn btn-default"><?= e(trans('backend::lang.form.return_to_list')); ?></a></p>
    </div>

<?php endif ?>
