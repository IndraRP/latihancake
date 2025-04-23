<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Sales'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sales form content">
            <?= $this->Form->create($sale) ?>
            <fieldset>
                <legend><?= __('Add Sale') ?></legend>
                <?php
                echo $this->Form->control('customer_id', ['options' => $customers]);
                echo $this->Form->control('sale_date');
                ?>
                <h4>Motorcycle</h4>
                <?= $this->Form->control('sale_details.0.motorcycle_id', [
                    'options' => $motorcycles,
                    'empty' => '-- Select Motor --',
                    'id' => 'motorcycle-id'
                ]) ?>

                <?= $this->Form->control('sale_details.0.quantity', ['id' => 'quantity', 'value' => 1]) ?>
                <?= $this->Form->control('sale_details.0.price', ['id' => 'price', 'readonly']) ?>

                <?= $this->Form->control('total', ['id' => 'total', 'readonly']) ?>

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