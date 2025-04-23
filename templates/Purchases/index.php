<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Purchase> $purchases
 */
?>
<div class="purchases index content">
    <?= $this->Html->link(__('New Purchase'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Purchases') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th class="Motorcycles">Motorcycles</th>
                    <th class="Quantity">Quantity</th>
                    <th class="Total">Total Biaya</th>
                    <th class="Notes">Notes</th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchases as $purchase): ?>
                    <tr>
                        <td><?= $this->Number->format($purchase->id) ?></td>
                        <?php if (!empty($purchase->purchase_details)): ?>
                            <?php $detail = $purchase->purchase_details[0]; ?>
                            <td><?= h($detail->motorcycle->name ?? 'Unknown') ?></td>
                            <td><?= $detail->quantity ?></td>
                            <td>Rp<?= number_format($detail->price) ?></td>
                        <?php else: ?>
                            <td colspan="3">Tidak ada detail</td>
                        <?php endif; ?>


                        <td><?= h(strlen($purchase->notes) > 30 ? substr($purchase->notes, 0, 35) . '...' : $purchase->notes) ?></td>

                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $purchase->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchase->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchase->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchase->id)]) ?>
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