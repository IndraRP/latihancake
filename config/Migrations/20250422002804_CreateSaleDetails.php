<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSaleDetails extends AbstractMigration
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
        $table = $this->table('sale_details');
        $table->addColumn('sale_id', 'integer')
            ->addColumn('motorcycle_id', 'integer')
            ->addColumn('quantity', 'integer')
            ->addColumn('price', 'integer')
            ->addTimestamps()
            ->addForeignKey('sale_id', 'sales', 'id', ['delete' => 'CASCADE'])
            ->addForeignKey('motorcycle_id', 'motorcycles', 'id', ['delete' => 'CASCADE'])
            ->create();
    }
}
