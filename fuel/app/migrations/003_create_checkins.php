<?php

namespace Fuel\Migrations;

class Create_checkins
{
	public function up()
	{
		\DBUtil::create_table('checkins', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true, 'null' => true),
			'place_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'latitude' => array('type' => 'float'),
			'longitude' => array('type' => 'float'),
			'accuracy' => array('constraint' => 11, 'type' => 'int'),
			'message' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

    ), array('id'), true, 'InnoDB', null, array(
      array(
        'key' => 'user_id',
        'reference' => array(
          'table' => 'users',
          'column' => 'id'
        )
      ),
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
		\DBUtil::drop_table('checkins');
	}

}
