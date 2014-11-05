<?php

namespace Fuel\Migrations;

class Create_likes
{
	public function up()
	{
		\DBUtil::create_table('likes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'place_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
    ), array('id'), true, 'InnoDB', null, array(
      array(
        'key' => 'place_id',
        'reference' => array(
          'table' => 'places',
          'column' => 'id'
        )
      )
    ));
	}

	public function down()
	{
		\DBUtil::drop_table('likes');
	}
}
