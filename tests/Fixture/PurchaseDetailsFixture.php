<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PurchaseDetailsFixture
 */
class PurchaseDetailsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'purchase_id' => 1,
                'motorcycle_id' => 1,
                'quantity' => 1,
                'price' => 1,
                'created_at' => 1745286330,
                'updated_at' => 1745286330,
            ],
        ];
        parent::init();
    }
}
