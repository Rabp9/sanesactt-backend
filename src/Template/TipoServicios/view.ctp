<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tipo Servicio'), ['action' => 'edit', $tipoServicio->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tipo Servicio'), ['action' => 'delete', $tipoServicio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tipoServicio->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tipo Servicios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tipo Servicio'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Estados'), ['controller' => 'Estados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Estado'), ['controller' => 'Estados', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tipoServicios view large-9 medium-8 columns content">
    <h3><?= h($tipoServicio->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($tipoServicio->descripcion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= $tipoServicio->has('estado') ? $this->Html->link($tipoServicio->estado->id, ['controller' => 'Estados', 'action' => 'view', $tipoServicio->estado->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tipoServicio->id) ?></td>
        </tr>
    </table>
</div>
