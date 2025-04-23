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
            <?= $this->Html->link(__('List Purchases'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="purchases form content">
            <?= $this->Form->create($purchase) ?>
            <fieldset>
                <legend><?= __('Add Purchase') ?></legend>

                <!-- Supplier -->
                <?= $this->Form->control('supplier_id', [
                    'options' => $suppliers,
                    'empty' => '-- Select Supplier --',
                ]) ?>

                <?= $this->Form->control('notes') ?>


                <h4>Purchase Details</h4>

                <!-- Motor -->
                <?= $this->Form->control('purchase_details.0.motorcycle_id', [
                    'options' => $motorcycles,
                    'empty' => '-- Select Motorcycle --',
                    'id' => 'motorcycle-id'  // Tambahkan ID di sini
                ]) ?>

                <?= $this->Form->control('purchase_details.0.quantity', [
                    'value' => 1,
                    'id' => 'quantity'  // Tambahkan ID di sini
                ]) ?>

                <?= $this->Form->control('purchase_details.0.price', [
                    'readonly' => true,
                    'id' => 'price'  // Tambahkan ID di sini
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
    });
</script>