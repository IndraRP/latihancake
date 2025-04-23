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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $purchase->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $purchase->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Purchases'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="purchases form content">
            <?= $this->Form->create($purchase) ?>
            <fieldset>
                <legend><?= __('Edit Purchase') ?></legend>

                <!-- Supplier -->
                <?= $this->Form->control('supplier_id', [
                    'options' => $suppliers,
                    'empty' => '-- Select Supplier --',
                ]) ?>

                <?= $this->Form->control('notes') ?>

                <h4>Purchase Details</h4>

                <?= $this->Form->control('purchase_details.0.id', [
                    'type' => 'hidden',
                ]) ?>

                <!-- Motor -->
                <?= $this->Form->control('purchase_details.0.motorcycle_id', [
                    'options' => $motorcycles,
                    'empty' => '-- Select Motorcycle --',
                    'id' => 'motorcycle-id'
                ]) ?>

                <?= $this->Form->control('purchase_details.0.quantity', [
                    'id' => 'quantity'
                ]) ?>

                <?= $this->Form->control('purchase_details.0.price', [
                    'readonly' => true,
                    'id' => 'price'
                ]) ?>

            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    const motorList = <?= json_encode($motorList) ?>;

    document.addEventListener('DOMContentLoaded', function() {
        const motorSelect = document.getElementById('motorcycle-id');
        const quantityInput = document.getElementById('quantity');
        const priceInput = document.getElementById('price');

        function updatePrice() {
            const motorId = motorSelect.value;
            const quantity = parseInt(quantityInput.value) || 0;
            const pricePerUnit = motorList[motorId] || 0;
            priceInput.value = pricePerUnit * quantity;
        }

        motorSelect.addEventListener('change', updatePrice);
        quantityInput.addEventListener('input', updatePrice);

        // Panggil langsung pas pertama kali form tampil
        updatePrice();
    });
</script>