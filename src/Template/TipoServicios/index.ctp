<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tipo Servicio'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Estados'), ['controller' => 'Estados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Estado'), ['controller' => 'Estados', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tipoServicios index large-9 medium-8 columns content">
    <h3><?= __('Tipo Servicios') ?></h3>
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
            <?php foreach ($tipoServicios as $tipoServicio): ?>
            <tr>
                <td><?= $this->Number->format($tipoServicio->id) ?></td>
                <td><?= h($tipoServicio->descripcion) ?></td>
                <td><?= $tipoServicio->has('estado') ? $this->Html->link($tipoServicio->estado->id, ['controller' => 'Estados', 'action' => 'view', $tipoServicio->estado->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tipoServicio->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tipoServicio->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tipoServicio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tipoServicio->id)]) ?>
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
