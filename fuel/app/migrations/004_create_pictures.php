<?php

namespace Fuel\Migrations;

class Create_pictures
{
	public function up()
	{
		\DBUtil::create_table('pictures', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'checkin_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'filepath' => array('constraint' => 255, 'type' => 'varchar'),
			'filename' => array('constraint' => 255, 'type' => 'varchar'),
			'extension' => array('constraint' => 4, 'type' => 'varchar'),
			'mimetype' => array('constraint' => 20, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

    ), array('id'), true, 'InnoDB', null, array(
      array(
        'key' => 'checkin_id',
        'reference' => array(
          'table' => 'checkins',
          'column' => 'id'
        )
      ),
      array(
        'key' => 'user_id',
        'reference' => array(
          'table' => 'users',
          'column' => 'id'
        )
      )
    ));
	}

	public function down()
	{
		\DBUtil::drop_table('pictures');
	}
}
