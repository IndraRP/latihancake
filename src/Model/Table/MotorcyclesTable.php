<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Motorcycles Model
 *
 * @property \App\Model\Table\PurchaseDetailsTable&\Cake\ORM\Association\HasMany $PurchaseDetails
 * @property \App\Model\Table\SaleDetailsTable&\Cake\ORM\Association\HasMany $SaleDetails
 *
 * @method \App\Model\Entity\Motorcycle newEmptyEntity()
 * @method \App\Model\Entity\Motorcycle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Motorcycle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Motorcycle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Motorcycle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Motorcycle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Motorcycle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Motorcycle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Motorcycle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Motorcycle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Motorcycle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Motorcycle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Motorcycle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MotorcyclesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('motorcycles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('PurchaseDetails', [
            'foreignKey' => 'motorcycle_id',
        ]);
        $this->hasMany('SaleDetails', [
            'foreignKey' => 'motorcycle_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('brand')
            ->maxLength('brand', 100)
            ->requirePresence('brand', 'create')
            ->notEmptyString('brand');

        $validator
            ->scalar('description')
            ->maxLength('description', 100)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('type')
            ->maxLength('type', 50)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->integer('stock')
            ->requirePresence('stock', 'create')
            ->notEmptyString('stock');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }
}
