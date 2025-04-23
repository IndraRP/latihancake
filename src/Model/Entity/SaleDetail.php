<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SaleDetail Entity
 *
 * @property int $id
 * @property int $sale_id
 * @property int $motorcycle_id
 * @property int $quantity
 * @property int $price
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\Sale $sale
 * @property \App\Model\Entity\Motorcycle $motorcycle
 */
class SaleDetail extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'sale_id' => true,
        'motorcycle_id' => true,
        'quantity' => true,
        'price' => true,
        'created_at' => true,
        'updated_at' => true,
        'sale' => true,
        'motorcycle' => true,
    ];
}
