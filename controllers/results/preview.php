<?php Block::put('breadcrumb') ?>
    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= Backend::url('beltechsoft/forms/results') ?>"><?php echo __('beltechsoft.forms::lang.controller.list_title')?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo __('beltechsoft.forms::lang.controller.previewing')?></li>
        </ol>
<?php Block::endPut() ?>

<?php if (!$this->fatalError): ?>
    <?php $fields = array_filter(array_pluck((array)$this->type->fields, 'label', 'name'))?>
    <div class="form-preview">
        <div class="control-table">
            <div class="table-content">
                <table class="table data mb-0">
                    <tbody>
                        <?php $model = $this->widget->form->model ?>
                            <tr>
                                <th>ID</th>
                                <th><?php echo $model->id?></th>
                            </tr>
                        <?php foreach ($model->data as $key => $value):?>
                            <tr>
                                <th><?php echo array_get($fields, $key, $key)?></th>
                                <th><?php echo $value?></th>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php else: ?>

    <p class="flash-message static error"><?= e($this->fatalError) ?></p>
    <p><a href="<?= Backend::url('beltechsoft/forms/results') ?>" class="btn btn-default"><?= e(trans('backend::lang.form.return_to_list')) ?></a></p>

<?php endif ?>
