<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Detalle Causa'), ['action' => 'edit', $detalleCausa->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Detalle Causa'), ['action' => 'delete', $detalleCausa->id], ['confirm' => __('Are you sure you want to delete # {0}?', $detalleCausa->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Detalle Causas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Detalle Causa'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Causas'), ['controller' => 'Causas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Causa'), ['controller' => 'Causas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Estados'), ['controller' => 'Estados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Estado'), ['controller' => 'Estados', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="detalleCausas view large-9 medium-8 columns content">
    <h3><?= h($detalleCausa->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($detalleCausa->descripcion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Causa') ?></th>
            <td><?= $detalleCausa->has('causa') ? $this->Html->link($detalleCausa->causa->id, ['controller' => 'Causas', 'action' => 'view', $detalleCausa->causa->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= $detalleCausa->has('estado') ? $this->Html->link($detalleCausa->estado->id, ['controller' => 'Estados', 'action' => 'view', $detalleCausa->estado->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($detalleCausa->id) ?></td>
        </tr>
    </table>
</div>
