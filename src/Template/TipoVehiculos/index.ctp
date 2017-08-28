<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tipo Vehiculo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Estados'), ['controller' => 'Estados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Estado'), ['controller' => 'Estados', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tipoVehiculos index large-9 medium-8 columns content">
    <h3><?= __('Tipo Vehiculos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tipoVehiculos as $tipoVehiculo): ?>
            <tr>
                <td><?= $this->Number->format($tipoVehiculo->id) ?></td>
                <td><?= h($tipoVehiculo->descripcion) ?></td>
                <td><?= $tipoVehiculo->has('estado') ? $this->Html->link($tipoVehiculo->estado->id, ['controller' => 'Estados', 'action' => 'view', $tipoVehiculo->estado->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tipoVehiculo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tipoVehiculo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tipoVehiculo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tipoVehiculo->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
