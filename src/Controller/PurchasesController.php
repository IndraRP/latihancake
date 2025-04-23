<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Purchases Controller
 *
 * @property \App\Model\Table\PurchasesTable $Purchases
 * @method \App\Model\Entity\Purchase[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchasesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $purchases = $this->paginate($this->Purchases->find()->contain(['PurchaseDetails.Motorcycles']));
        $this->set(compact('purchases'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchase = $this->Purchases->get($id, [
            'contain' => ['Suppliers', 'PurchaseDetails.Motorcycles'], // atau model lain yang kamu butuhkan
        ]);

        $this->set(compact('purchase'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $purchase = $this->Purchases->newEmptyEntity();

    //     // Ambil data supplier dan motor
    //     $motorcycles = $this->Purchases->PurchaseDetails->Motorcycles->find('list')->all();
    //     $suppliers = $this->Purchases->Suppliers->find('list')->all();
    //     $motorList = $this->Purchases->PurchaseDetails->Motorcycles->find()
    //         ->all()
    //         ->combine('id', 'price')
    //         ->toArray();

    //     // dd($motorList);

    //     if ($this->request->is('post')) {
    //         $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData(), [
    //             'associated' => ['PurchaseDetails']
    //         ]);

    //         if ($this->Purchases->save($purchase)) {
    //             $this->Flash->success(__('The purchase has been saved.'));
    //             return $this->redirect(['action' => 'index']);
    //         }

    //         $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
    //     }

    //     // Kirim data ke view
    //     $this->set(compact('purchase', 'motorcycles', 'motorList', 'suppliers'));
    // }


    public function add()
    {
        $purchase = $this->Purchases->newEmptyEntity();

        $motorcycles = $this->Purchases->PurchaseDetails->Motorcycles->find('list')->all();
        $suppliers = $this->Purchases->Suppliers->find('list')->all();
        $motorList = $this->Purchases->PurchaseDetails->Motorcycles->find()
            ->all()
            ->combine('id', 'price')
            ->toArray();

        if ($this->request->is('post')) {
            $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData(), [
                'associated' => ['PurchaseDetails']
            ]);

            // dd($this->request->getData());

            if ($this->Purchases->save($purchase)) {
                // ✅ Update stok motor berdasarkan quantity
                foreach ($purchase->purchase_details as $detail) {
                    $motorcycle = $this->Purchases->PurchaseDetails->Motorcycles->get($detail->motorcycle_id);
                    $motorcycle->stock += $detail->quantity;
                    $this->Purchases->PurchaseDetails->Motorcycles->save($motorcycle);
                }

                $this->Flash->success(__('The purchase has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
        }

        $this->set(compact('purchase', 'motorcycles', 'motorList', 'suppliers'));
    }



    /**
     * Edit method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function edit($id = null)
    {
        // Ambil data utama beserta relasi
        $purchase = $this->Purchases->get($id, [
            'contain' => ['PurchaseDetails']
        ]);

        // Ambil data supplier dan motor
        $motorcycles = $this->Purchases->PurchaseDetails->Motorcycles->find('list')->all();
        $suppliers = $this->Purchases->Suppliers->find('list')->all();
        $motorList = $this->Purchases->PurchaseDetails->Motorcycles->find()
            ->all()
            ->combine('id', 'price')
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData(), [
                'associated' => ['PurchaseDetails']
            ]);

            // Hitung ulang total_amount
            $totalAmount = 0;
            foreach ($purchase->purchase_details as $detail) {
                $totalAmount += $detail->quantity * $detail->price;
            }
            $purchase->total_amount = $totalAmount;

            if ($this->Purchases->save($purchase)) {
                // ✅ Update stok motor berdasarkan quantity
                foreach ($purchase->purchase_details as $detail) {
                    $motorcycle = $this->Purchases->PurchaseDetails->Motorcycles->get($detail->motorcycle_id);
                    $motorcycle->stock += $detail->quantity;
                    $this->Purchases->PurchaseDetails->Motorcycles->save($motorcycle);
                }

                $this->Flash->success(__('The purchase has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The purchase could not be updated. Please, try again.'));
        }

        $this->set(compact('purchase', 'motorcycles', 'motorList', 'suppliers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchase = $this->Purchases->get($id);
        if ($this->Purchases->delete($purchase)) {
            $this->Flash->success(__('The purchase has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
