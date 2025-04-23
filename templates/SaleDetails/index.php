<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\SaleDetail> $saleDetails
 */
?>
<div class="saleDetails index content">
    <?= $this->Html->link(__('New Sale Detail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Sale Details') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('sale_id') ?></th>
                    <th><?= $this->Paginator->sort('motorcycle_id') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($saleDetails as $saleDetail): ?>
                <tr>
                    <td><?= $this->Number->format($saleDetail->id) ?></td>
                    <td><?= $saleDetail->has('sale') ? $this->Html->link($saleDetail->sale->id, ['controller' => 'Sales', 'action' => 'view', $saleDetail->sale->id]) : '' ?></td>
                    <td><?= $saleDetail->has('motorcycle') ? $this->Html->link($saleDetail->motorcycle->name, ['controller' => 'Motorcycles', 'action' => 'view', $saleDetail->motorcycle->id]) : '' ?></td>
                    <td><?= $this->Number->format($saleDetail->quantity) ?></td>
                    <td><?= $this->Number->format($saleDetail->price) ?></td>
                    <td><?= h($saleDetail->created_at) ?></td>
                    <td><?= h($saleDetail->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $saleDetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $saleDetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $saleDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saleDetail->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
