<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $order->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="orders form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Edit Order') ?></legend>
        <!-- 発注確認 adminのみ表示 -->
        <?php if($order->order_status == 'hattyukakunin'  ): ?>
                <?php if($user["role"]=='admin'): ?>
                    <p>管理者の確認が必要です。</p>
                    <?php
                        var_dump($order->order_status);
                        echo $this->Form->hidden('ordername');
                        echo $this->Form->hidden('order_price');
                        echo $this->Form->hidden('order_quantity');
                    ?>
                    <input type="hidden" name="order_status" value="kanrisyakakunizumi"/>
                <?php else: ?>
                <p>管理者確認ができていないので、管理ユーザーでログインして下さい。</p>
            <?php endif ;?>
        <?php elseif($order->order_status == 'kanrisyakakunizumi'): ?>
        <p>管理者確認済み、発注を行って下さい。</p>
            <?php if($user["role"] == "received"): ?>
            <p>発注は受注会社できません、adminかuserでログインして下さい。</p>
            <?php else:?>
                    <?php
                        var_dump($order->order_status);
                        echo $this->Form->hidden('ordername');
                        echo $this->Form->hidden('order_price');
                        echo $this->Form->hidden('order_quantity');
                    ?>
                    <input type="hidden" name="order_status" value="syouninzumi"/>
            <?php endif ;?>
        <!-- 受注会社確認 -->
        <?php elseif($order->order_status == 'syouninzumi'): ?>
        <p>発注承認済み</p>
        <?php if($user["role"] == "received"): ?>
            <?php
                        var_dump($order->order_status);
                        echo $this->Form->hidden('ordername');
                        echo $this->Form->hidden('order_price');
                        echo $this->Form->hidden('order_quantity');
                    ?>
                    <input type="hidden" name="order_status" value="syouninzumi"/>
            <?php else:?>
            <p>受注は発注会社ではできません</p>
            <?php endif ;?>
        <!-- 受注完了 -->
        <?php elseif($order->order_status == 'zyutyuzumi'): ?>
        <p>受注完了</p>
        <?php endif ;?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

