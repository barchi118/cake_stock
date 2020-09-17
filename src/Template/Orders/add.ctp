<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>





<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<?php if($user["role"] == "received"): ?>
<p>発注は受注会社できません</p>
<?php else:?>
<div class="orders form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Add Order') ?></legend>
        <?php
            echo $this->Form->control('ordername');
            echo $this->Form->control('order_price');
            echo $this->Form->control('order_quantity');
            echo $this->Form->hidden('order_status',array('default' => 'hattyukakunin'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?php endif;?>
