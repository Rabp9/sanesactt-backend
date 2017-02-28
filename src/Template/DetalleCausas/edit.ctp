<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $detalleCausa->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $detalleCausa->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Detalle Causas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Causas'), ['controller' => 'Causas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Causa'), ['controller' => 'Causas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Estados'), ['controller' => 'Estados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Estado'), ['controller' => 'Estados', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="detalleCausas form large-9 medium-8 columns content">
    <?= $this->Form->create($detalleCausa) ?>
    <fieldset>
        <legend><?= __('Edit Detalle Causa') ?></legend>
        <?php
            echo $this->Form->input('descripcion');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
