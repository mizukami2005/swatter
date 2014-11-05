<?php

namespace Fuel\Migrations;

class Create_users
{
	public function up()
	{
		\DBUtil::create_table('users', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'tw_id' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'), true, 'InnoDB');

    \DBUtil::create_index('users', 'tw_id', 'tw_id', 'UNIQUE');
	}

	public function down()
	{
    \DBUtil::drop_table('users');
	}
}
