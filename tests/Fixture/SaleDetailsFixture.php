<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SaleDetailsFixture
 */
class SaleDetailsFixture extends TestFixture
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
                'sale_id' => 1,
                'motorcycle_id' => 1,
                'quantity' => 1,
                'price' => 1,
                'created_at' => 1745286597,
                'updated_at' => 1745286597,
            ],
        ];
        parent::init();
    }
}
