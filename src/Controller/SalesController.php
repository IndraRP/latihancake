<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Sales Controller
 *
 * @property \App\Model\Table\SalesTable $Sales
 * @method \App\Model\Entity\Sale[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers', 'SaleDetails.Motorcycles'],
        ];
        $sales = $this->paginate($this->Sales);

        $this->set(compact('sales'));
    }

    /**
     * View method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sale = $this->Sales->get($id, [
            'contain' => ['Customers', 'SaleDetails'],
        ]);

        $this->set(compact('sale'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sale = $this->Sales->newEmptyEntity();

        if ($this->request->is('post')) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData(), [
                'associated' => ['SaleDetails']
            ]);

            // dd($this->request->getData());
            // dd($sale->getErrors());



            // if ($this->Sales->save($sale)) {
            //     $this->Flash->success(__('The sale has been saved.'));
            //     return $this->redirect(['action' => 'index']);
            // }

            if ($this->Sales->save($sale)) {
                // ✅ Update stok motor berdasarkan quantity
                foreach ($sale->sale_details as $detail) {
                    $motorcycle = $this->Sales->SaleDetails->Motorcycles->get($detail->motorcycle_id);
                    $motorcycle->stock -= $detail->quantity;
                    $this->Sales->SaleDetails->Motorcycles->save($motorcycle);
                }

                $this->Flash->success(__('The purchase has been saved.'));
                return $this->redirect(['action' => 'index']);
            }


            debug($sale->getErrors());
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }

        $customers = $this->Sales->Customers->find('list')->all();
        $motorcycles = $this->Sales->SaleDetails->Motorcycles->find('list')->all();

        $motorList = $this->Sales->SaleDetails->Motorcycles->find()
            ->all()
            ->combine('id', 'price')
            ->toArray();

        $this->set(compact('sale', 'customers', 'motorcycles', 'motorList'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sale = $this->Sales->get($id, [
            'contain' => ['SaleDetails'],
        ]);

        // Simpan data lama sebelum diedit
        $oldDetails = [];
        foreach ($sale->sale_details as $detail) {
            $oldDetails[$detail->id] = [
                'motorcycle_id' => $detail->motorcycle_id,
                'quantity' => $detail->quantity
            ];
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData(), [
                'associated' => ['SaleDetails']
            ]);

            if ($this->Sales->save($sale)) {
                foreach ($sale->sale_details as $detail) {
                    // Ambil data lama jika ada
                    $oldQty = 0;
                    $oldMotorId = $detail->motorcycle_id;

                    if (isset($oldDetails[$detail->id])) {
                        $oldQty = $oldDetails[$detail->id]['quantity'];
                        $oldMotorId = $oldDetails[$detail->id]['motorcycle_id'];
                    }

                    // Jika motor diganti, kita harus update 2 stok motor
                    if ($oldMotorId != $detail->motorcycle_id) {
                        // Tambah stok motor lama
                        $oldMotor = $this->Sales->SaleDetails->Motorcycles->get($oldMotorId);
                        $oldMotor->stock += $oldQty;
                        $this->Sales->SaleDetails->Motorcycles->save($oldMotor);

                        // Kurangi stok motor baru
                        $newMotor = $this->Sales->SaleDetails->Motorcycles->get($detail->motorcycle_id);
                        $newMotor->stock -= $detail->quantity;
                        $this->Sales->SaleDetails->Motorcycles->save($newMotor);
                    } else {
                        // Kalau motor tidak berubah, cukup hitung selisih quantity
                        $motorcycle = $this->Sales->SaleDetails->Motorcycles->get($detail->motorcycle_id);
                        $motorcycle->stock += ($oldQty - $detail->quantity);
                        $this->Sales->SaleDetails->Motorcycles->save($motorcycle);
                    }
                }

                $this->Flash->success(__('The sale has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }

        $customers = $this->Sales->Customers->find('list', ['limit' => 200])->all();
        $motorcycles = $this->Sales->SaleDetails->Motorcycles->find('list')->all();
        $motorList = $this->Sales->SaleDetails->Motorcycles->find()
            ->all()
            ->combine('id', 'price')
            ->toArray();

        $this->set(compact('sale', 'customers', 'motorcycles', 'motorList'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sale = $this->Sales->get($id);
        if ($this->Sales->delete($sale)) {
            $this->Flash->success(__('The sale has been deleted.'));
        } else {
            $this->Flash->error(__('The sale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
