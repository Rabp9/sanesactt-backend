<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tipoVehiculo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tipoVehiculo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tipo Vehiculos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Estados'), ['controller' => 'Estados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Estado'), ['controller' => 'Estados', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tipoVehiculos form large-9 medium-8 columns content">
    <?= $this->Form->create($tipoVehiculo) ?>
    <fieldset>
        <legend><?= __('Edit Tipo Vehiculo') ?></legend>
        <?php
            echo $this->Form->input('descripcion');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
