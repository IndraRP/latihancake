<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSales extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('sales');
        $table->addColumn('customer_id', 'integer')  // Menjaga kolom tetap NOT NULL
            ->addColumn('sale_date', 'date')
            ->addColumn('total', 'integer')
            ->addTimestamps()
            ->addForeignKey('customer_id', 'customers', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }
}
