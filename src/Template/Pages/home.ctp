<style>


</style>

<div class="container card mt-3 ">
    <div class="header-title card-body">
        
    </div>
    <div class="row   center-block px-2 mx-auto d-flex justify-content-center"><!-- 真ん中寄席にする-->
        <!-- 在庫一覧 -->
        <h1 class="col-12" style="font-size:28px;font-wight:bold;">発注・在庫の管理をする</h1>
        <div class="col-lg-6 bg-secondary rounded mt-2" style="bg-color:#0066ff;">
            <h4 class="text-white pt-2"><?= $this->Html->link(__('在庫リスト'), ['controller' => 'Stocks','action' => 'index']) ?></h4>
            <p class="d-lg-block d-none text-white" style="font-size:12px;">在庫の一覧を確認できます。</p>
        </div>
        <!-- ユーザー一覧 -->
        <div class="col-lg-6 bg-secondary rounded mt-2">
            <h4 class="text-white pt-2"><?= $this->Html->link(__('ユーザーリスト'), ['controller' => 'Users','action' => 'index']) ?></h4>
            <p class="d-none d-lg-block  text-white" style="font-size:12px;">ユーザーの一覧を確認できます。</p>
        </div>
        <!-- 発注一覧 -->
        <div class="col-lg-6 bg-secondary rounded mt-2">
            <h4 class="text-white pt-2"><?= $this->Html->link(__('発注リスト'), ['controller' => 'Orders','action' => 'index']) ?></h4>
            <p  class="d-none d-lg-block  text-white" style="font-size:12px;">発注情報の確認や発注ステータスの更新ができます</p>
        </div>
        <!-- 発注作成 -->
        <div class="col-lg-6 bg-secondary rounded mt-2">
            <h4  class="text-white pt-2"><?= $this->Html->link(__('発注'), ['controller' => 'Orders','action' => 'add']) ?></h4>
            <p  class="d-none d-lg-block  text-white" style="font-size:12px;">管理者とユーザーで新規に発注ができます</p>
        </div>
    </div>
    <!-- カードのフッター -->
    <div class="row border-top mt-3">
        <div class="card-body">
            <h3 class="card-title border-bottom d-inline ">会社</h3>
            <p class="mt-3">株式会社ペンギン大好き</p>
            <p>東京都品川区西五反田100-100-100-1001</p>
            <p>TEL：03-XXXX-XXXX</p>
            <p>法人番号：XXXXXXXXXXXXXXXX</p>
        </div>
    </div>
</div>



