<?php Block::put('breadcrumb') ?>
    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= Backend::url('beltechsoft/forms/types') ?>"><?php echo __('beltechsoft.forms::lang.controller.list_title')?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo __('beltechsoft.forms::lang.controller.previewing')?></li>
        </ol>
<?php Block::endPut() ?>

<?php if (!$this->fatalError): ?>

    <div class="form-preview">
        <?= $this->formRenderPreview() ?>
    </div>

<?php else: ?>

    <p class="flash-message static error"><?= e($this->fatalError) ?></p>
    <p><a href="<?= Backend::url('beltechsoft/forms/types') ?>" class="btn btn-default"><?= e(trans('backend::lang.form.return_to_list')) ?></a></p>

<?php endif ?>
