<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Motorcycle Entity
 *
 * @property int $id
 * @property string $name
 * @property string $brand
 * @property string $description
 * @property string $type
 * @property int $price
 * @property int $stock
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\PurchaseDetail[] $purchase_details
 * @property \App\Model\Entity\SaleDetail[] $sale_details
 */
class Motorcycle extends Entity
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
        'name' => true,
        'brand' => true,
        'description' => true,
        'type' => true,
        'price' => true,
        'stock' => true,
        'created_at' => true,
        'updated_at' => true,
        'purchase_details' => true,
        'sale_details' => true,
    ];
}
