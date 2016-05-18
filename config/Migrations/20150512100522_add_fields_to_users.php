<?php
use Phinx\Migration\AbstractMigration;

class AddFieldsToUsers extends AbstractMigration
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
        $table->addColumn('first_name', 'string', ['after'=>'id','default' => null, 'limit' => 255,'null' => true,])
            ->addColumn('last_name', 'string', ['after'=>'first_name','default' => null, 'limit' => 255, 'null' => true, ])
            ->addColumn('gender','boolean',['after'=>'last_name','default'=>0,'null'=>true]);
        $table->update();
    }
}
