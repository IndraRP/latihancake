<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\PurchaseDetail> $purchaseDetails
 */
?>
<div class="purchaseDetails index content">
    <?= $this->Html->link(__('New Purchase Detail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Purchase Details') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('purchase_id') ?></th>
                    <th><?= $this->Paginator->sort('motorcycle_id') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchaseDetails as $purchaseDetail): ?>
                <tr>
                    <td><?= $this->Number->format($purchaseDetail->id) ?></td>
                    <td><?= $purchaseDetail->has('purchase') ? $this->Html->link($purchaseDetail->purchase->id, ['controller' => 'Purchases', 'action' => 'view', $purchaseDetail->purchase->id]) : '' ?></td>
                    <td><?= $purchaseDetail->has('motorcycle') ? $this->Html->link($purchaseDetail->motorcycle->name, ['controller' => 'Motorcycles', 'action' => 'view', $purchaseDetail->motorcycle->id]) : '' ?></td>
                    <td><?= $this->Number->format($purchaseDetail->quantity) ?></td>
                    <td><?= $this->Number->format($purchaseDetail->price) ?></td>
                    <td><?= h($purchaseDetail->created_at) ?></td>
                    <td><?= h($purchaseDetail->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseDetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseDetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseDetail->id)]) ?>
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
