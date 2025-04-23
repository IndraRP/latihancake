<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 * @var \Cake\Collection\CollectionInterface $motorcycles
 * @var array $motorList
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $sale->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $sale->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Sales'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sales form content">
            <?= $this->Form->create($sale) ?>
            <fieldset>
                <legend><?= __('Edit Sale') ?></legend>
                <?php
                echo $this->Form->control('customer_id', ['options' => $customers]);
                echo $this->Form->control('sale_date');
                ?>
                <h4>Motorcycle</h4>
                <?= $this->Form->control('sale_details.0.id', [
                    'type' => 'hidden',
                ]) ?>

                <?= $this->Form->control('sale_details.0.motorcycle_id', [
                    'options' => $motorcycles,
                    'empty' => '-- Select Motorcycle --',
                    'id' => 'motorcycle-id',
                    'value' => $sale->sale_details[0]->motorcycle_id // Make sure the current motorcycle_id is selected
                ]) ?>

                <?= $this->Form->control('sale_details.0.quantity', [
                    'id' => 'quantity',
                    'value' => $sale->sale_details[0]->quantity // Set the quantity to the existing value
                ]) ?>

                <?= $this->Form->control('sale_details.0.price', [
                    'id' => 'price',
                    'readonly' => true,
                    'value' => $sale->sale_details[0]->price // Set the price to the existing value
                ]) ?>

                <?= $this->Form->control('total', [
                    'id' => 'total',
                    'readonly' => true,
                    'value' => $sale->total // Set the total to the existing value
                ]) ?>

            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    const motorPrices = <?= json_encode($motorList) ?>;

    document.getElementById('motorcycle-id').addEventListener('change', function() {
        const selectedId = this.value;
        const price = motorPrices[selectedId] || 0;
        document.getElementById('price').value = price;
        updateTotal();
    });

    document.getElementById('quantity').addEventListener('input', updateTotal);

    function updateTotal() {
        const qty = parseInt(document.getElementById('quantity').value) || 0;
        const price = parseInt(document.getElementById('price').value) || 0;
        document.getElementById('total').value = qty * price;
    }
</script>