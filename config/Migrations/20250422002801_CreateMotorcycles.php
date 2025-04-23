<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMotorcycles extends AbstractMigration
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
        $table = $this->table('motorcycles');
        $table->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('brand', 'string', ['limit' => 100])
            ->addColumn('description', 'string', ['limit' => 100])
            ->addColumn('type', 'string', ['limit' => 50])
            ->addColumn('price', 'integer')
            ->addColumn('stock', 'integer')
            ->addTimestamps()
            ->create();
    }
}
