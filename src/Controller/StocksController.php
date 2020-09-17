<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Stocks Controller
 *
 * @property \App\Model\Table\StocksTable $Stocks
 *
 * @method \App\Model\Entity\Stock[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StocksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $stocks = $this->paginate($this->Stocks);

        $this->set(compact('stocks'));
    }

    /**
     * View method
     *
     * @param string|null $id Stock id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stock = $this->Stocks->get($id, [
            'contain' => [],
        ]);

        $this->set('stock', $stock);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stock = $this->Stocks->newEntity();
        if ($this->request->is('post')) {
            $stock = $this->Stocks->patchEntity($stock, $this->request->getData());
            if ($this->Stocks->save($stock)) {
                $this->Flash->success(__('The stock has been saved.'));
                $this->log(print_r($this->request->getData(),true));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock could not be saved. Please, try again.'));
        }
        $this->set(compact('stock'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stock id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stock = $this->Stocks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stock = $this->Stocks->patchEntity($stock, $this->request->getData());
            if ($this->Stocks->save($stock)) {
                $this->Flash->success(__('The stock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock could not be saved. Please, try again.'));
        }
        $this->set(compact('stock'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stock id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stock = $this->Stocks->get($id);
        if ($this->Stocks->delete($stock)) {
            $this->Flash->success(__('The stock has been deleted.'));
        } else {
            $this->Flash->error(__('The stock could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function csv()
    {
        $stocks = $this->Stocks->find('All');
        $csvArrs = [];
        // ①ファイル作成し開く
        // ②ファイルに内容を書き込む
        // ③ファイルを閉じる
        // 書き込む内容を作成する。

        //出力する値の設定（配列）
        foreach ($stocks as $key => $val) {

          array_push($csvArrs, array(
            $val['id'],
            $val['stockname'],
            $val['price'],
            $val['stock_quantity'],
            $val['created'],
          ));
        }
        // 保存場所とファイルの設定
        $dirPath = dirname(__FILE__).'/csv/';
        //※dirPathが存在しなかったら新しく作るよう修正しました。
        if(!file_exists($dirPath)){
            mkdir($dirPath);
        }

        $file = $dirPath. date('YmdHis') . '.csv';

        // ファイルを書き込み用で開く
        $f = fopen($file, 'w');

        // 正常にファイルを開けていれば書き込む
        // var_dump($csvArrs);
          if($f){
            // ヘッダーの出力
            $header = array("product_id", "product_name", "price", "stock_quantity",  "create", );
            fputcsv($f, $header);
            // データの出力
            foreach($csvArrs as $csvArr){
                // 出力するデータを整形
                var_dump($csvArr);
            $data = array(
                    $csvArr[0], // product_id
                    $csvArr[1], // product_name
                    $csvArr[2], // price
                    $csvArr[3], // stock_quantity
                    $csvArr[4], // create_date
                );
                // ファイルに書き込み
                fputcsv($f, $data);}
                // ファイルを閉じる
            fclose($f);
            // 成功メッセージ
            $this->Flash->success(__('CSVがエクスポートされました。Controllerフォルダ内のCSVフォルダを確認してください'));
            }else{
            // 失敗メッセージ
            $this->Flash->error(__('CSV出力に失敗しました'));
        }
        // 検索結果画面に遷移
        return $this->redirect(['action' => 'index']);
            
    }
}
