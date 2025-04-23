<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SaleDetails Controller
 *
 * @property \App\Model\Table\SaleDetailsTable $SaleDetails
 * @method \App\Model\Entity\SaleDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SaleDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sales', 'Motorcycles'],
        ];
        $saleDetails = $this->paginate($this->SaleDetails);

        $this->set(compact('saleDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Sale Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $saleDetail = $this->SaleDetails->get($id, [
            'contain' => ['Sales', 'Motorcycles'],
        ]);

        $this->set(compact('saleDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $saleDetail = $this->SaleDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $saleDetail = $this->SaleDetails->patchEntity($saleDetail, $this->request->getData());
            if ($this->SaleDetails->save($saleDetail)) {
                $this->Flash->success(__('The sale detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale detail could not be saved. Please, try again.'));
        }
        $sales = $this->SaleDetails->Sales->find('list', ['limit' => 200])->all();
        $motorcycles = $this->SaleDetails->Motorcycles->find('list', ['limit' => 200])->all();
        $this->set(compact('saleDetail', 'sales', 'motorcycles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sale Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $saleDetail = $this->SaleDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $saleDetail = $this->SaleDetails->patchEntity($saleDetail, $this->request->getData());
            if ($this->SaleDetails->save($saleDetail)) {
                $this->Flash->success(__('The sale detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale detail could not be saved. Please, try again.'));
        }
        $sales = $this->SaleDetails->Sales->find('list', ['limit' => 200])->all();
        $motorcycles = $this->SaleDetails->Motorcycles->find('list', ['limit' => 200])->all();
        $this->set(compact('saleDetail', 'sales', 'motorcycles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sale Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $saleDetail = $this->SaleDetails->get($id);
        if ($this->SaleDetails->delete($saleDetail)) {
            $this->Flash->success(__('The sale detail has been deleted.'));
        } else {
            $this->Flash->error(__('The sale detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
