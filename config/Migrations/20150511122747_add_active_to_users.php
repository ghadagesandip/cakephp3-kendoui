<?php
use Phinx\Migration\AbstractMigration;

class AddActiveToUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('active', 'boolean', [
            'default' => 1,
            'null' => true,
        ]);
        $table->update();
    }
}
