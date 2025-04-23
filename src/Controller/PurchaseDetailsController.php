<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PurchaseDetails Controller
 *
 * @property \App\Model\Table\PurchaseDetailsTable $PurchaseDetails
 * @method \App\Model\Entity\PurchaseDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Purchases', 'Motorcycles'],
        ];
        $purchaseDetails = $this->paginate($this->PurchaseDetails);

        $this->set(compact('purchaseDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseDetail = $this->PurchaseDetails->get($id, [
            'contain' => ['Purchases', 'Motorcycles'],
        ]);

        $this->set(compact('purchaseDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchaseDetail = $this->PurchaseDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $purchaseDetail = $this->PurchaseDetails->patchEntity($purchaseDetail, $this->request->getData());
            if ($this->PurchaseDetails->save($purchaseDetail)) {
                $this->Flash->success(__('The purchase detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase detail could not be saved. Please, try again.'));
        }
        $purchases = $this->PurchaseDetails->Purchases->find('list', ['limit' => 200])->all();
        $motorcycles = $this->PurchaseDetails->Motorcycles->find('list', ['limit' => 200])->all();
        $this->set(compact('purchaseDetail', 'purchases', 'motorcycles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseDetail = $this->PurchaseDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseDetail = $this->PurchaseDetails->patchEntity($purchaseDetail, $this->request->getData());
            if ($this->PurchaseDetails->save($purchaseDetail)) {
                $this->Flash->success(__('The purchase detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase detail could not be saved. Please, try again.'));
        }
        $purchases = $this->PurchaseDetails->Purchases->find('list', ['limit' => 200])->all();
        $motorcycles = $this->PurchaseDetails->Motorcycles->find('list', ['limit' => 200])->all();
        $this->set(compact('purchaseDetail', 'purchases', 'motorcycles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseDetail = $this->PurchaseDetails->get($id);
        if ($this->PurchaseDetails->delete($purchaseDetail)) {
            $this->Flash->success(__('The purchase detail has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
