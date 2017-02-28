<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Detalle Causa'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Causas'), ['controller' => 'Causas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Causa'), ['controller' => 'Causas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Estados'), ['controller' => 'Estados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Estado'), ['controller' => 'Estados', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="detalleCausas index large-9 medium-8 columns content">
    <h3><?= __('Detalle Causas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('causa_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalleCausas as $detalleCausa): ?>
            <tr>
                <td><?= $this->Number->format($detalleCausa->id) ?></td>
                <td><?= h($detalleCausa->descripcion) ?></td>
                <td><?= $detalleCausa->has('causa') ? $this->Html->link($detalleCausa->causa->id, ['controller' => 'Causas', 'action' => 'view', $detalleCausa->causa->id]) : '' ?></td>
                <td><?= $detalleCausa->has('estado') ? $this->Html->link($detalleCausa->estado->id, ['controller' => 'Estados', 'action' => 'view', $detalleCausa->estado->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $detalleCausa->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $detalleCausa->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $detalleCausa->id], ['confirm' => __('Are you sure you want to delete # {0}?', $detalleCausa->id)]) ?>
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
