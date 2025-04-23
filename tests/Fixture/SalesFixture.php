<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalesFixture
 */
class SalesFixture extends TestFixture
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
                'customer_id' => 1,
                'sale_date' => '2025-04-22',
                'total' => 1,
                'created_at' => 1745286540,
                'updated_at' => 1745286540,
            ],
        ];
        parent::init();
    }
}
