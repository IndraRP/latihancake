<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchase $purchase
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Purchase'), ['action' => 'edit', $purchase->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Purchase'), ['action' => 'delete', $purchase->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchase->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Purchases'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Purchase'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="purchases view content">
            <h3><?= h($purchase->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($purchase->id) ?></td>
                </tr>

                <tr>
                    <th><?= __('Notes') ?></th>
                    <td><?= h($purchase->notes) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Purchase Details') ?></h4>
                <?php if (!empty($purchase->purchase_details)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Purchase Id') ?></th>
                                <th><?= __('Motorcycle Id') ?></th>
                                <th><?= __('Quantity') ?></th>
                                <th><?= __('Price') ?></th>
                                <th><?= __('Created At') ?></th>
                                <th><?= __('Updated At') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($purchase->purchase_details as $purchaseDetails) : ?>
                                <tr>
                                    <td><?= h($purchaseDetails->id) ?></td>
                                    <td><?= h($purchaseDetails->purchase_id) ?></td>
                                    <td><?= h($purchaseDetails->motorcycle->name ?? 'Unknown') ?></td>
                                    <td><?= h($purchaseDetails->quantity) ?></td>
                                    <td><?= h($purchaseDetails->price) ?></td>
                                    <td><?= h($purchaseDetails->created_at) ?></td>
                                    <td><?= h($purchaseDetails->updated_at) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'PurchaseDetails', 'action' => 'view', $purchaseDetails->id]) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'PurchaseDetails', 'action' => 'edit', $purchaseDetails->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'PurchaseDetails', 'action' => 'delete', $purchaseDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseDetails->id)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>