<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePurchaseDetails extends AbstractMigration
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
        $table = $this->table('purchase_details');
        $table->addColumn('purchase_id', 'integer')
            ->addColumn('motorcycle_id', 'integer')
            ->addColumn('quantity', 'integer')
            ->addColumn('price', 'integer')
            ->addTimestamps()
            ->addForeignKey('purchase_id', 'purchases', 'id', ['delete' => 'CASCADE'])
            ->addForeignKey('motorcycle_id', 'motorcycles', 'id', ['delete' => 'CASCADE'])
            ->create();
    }
}
