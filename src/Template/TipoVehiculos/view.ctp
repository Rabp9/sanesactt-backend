<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tipo Vehiculo'), ['action' => 'edit', $tipoVehiculo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tipo Vehiculo'), ['action' => 'delete', $tipoVehiculo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tipoVehiculo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tipo Vehiculos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tipo Vehiculo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Estados'), ['controller' => 'Estados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Estado'), ['controller' => 'Estados', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tipoVehiculos view large-9 medium-8 columns content">
    <h3><?= h($tipoVehiculo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($tipoVehiculo->descripcion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= $tipoVehiculo->has('estado') ? $this->Html->link($tipoVehiculo->estado->id, ['controller' => 'Estados', 'action' => 'view', $tipoVehiculo->estado->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tipoVehiculo->id) ?></td>
        </tr>
    </table>
</div>
