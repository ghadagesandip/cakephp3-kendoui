<?php

use Phinx\Migration\AbstractMigration;

class Initial extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
     *
     * */


    public function change()
    {
        $bookmarks = $this->table('bookmarks');
        $bookmarks->addColumn('user_id','integer',['limit'=>200])
            ->addColumn('title','string')
            ->addColumn('description','text')
            ->addColumn('url','string',['limit'=>200])
            ->addColumn('created','datetime',['null'=>true])
            ->addColumn('updated','datetime',['null'=>true])
            ->save();


        $bookmarkTags = $this->table('bookmark_tags',['id'=>false]);
        $bookmarkTags->addColumn('bookmark_id','integer')
            ->addColumn('tag_id','integer',['null'=>true])
            ->save();

        $tags = $this->table('tags');
        $tags->addColumn('title','string')
            ->addColumn('created','datetime',['null'=>true])
            ->addColumn('updated','datetime',['null'=>true])
            ->save();

        $users = $this->table('users');
        $users->addColumn('email','string',['limit'=>200])
            ->addColumn('password','string',['limit'=>200])
            ->addColumn('created','datetime',['null'=>true])
            ->addColumn('updated','datetime',['null'=>true])
            ->save();
    }

    
    /**
     * Migrate Up.
     */
    public function up()
    {

    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}