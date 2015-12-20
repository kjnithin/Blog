
<div class="row">

<div class="col-md-4">
</div>

<div class="col-md-4">

    <?= $this->Form->create($tag) ?>
    <fieldset>
        <legend><?= __('Add Tag') ?></legend>
        <?php
            echo $this->Form->input('name', ['class' => 'form-control']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-info form-control', 'id' => 'tag_submitBtn']) ?>
    <?= $this->Form->end() ?>
    <?= $this->Html->link(__('Back to Tags List'), ['action' => 'index']) ?>
</div>

<div class="col-md-4">
</div>

</div>