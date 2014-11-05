<?php

namespace Fuel\Migrations;

class Create_mayorships
{
	public function up()
	{
		\DBUtil::create_table('mayorships', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true, 'null' => true),
			'area' => array('constraint' => 11, 'type' => 'int'),
			'rank' => array('constraint' => 1, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

    ), array('id'), true, 'InnoDB', null, array(
      array(
        'key' => 'user_id',
        'reference' => array(
          'table' => 'users',
          'column' => 'id'
        )
      )
    ));
    \DBUtil::create_index('mayorships', 'area');
	}

	public function down()
	{
    \DBUtil::drop_index('mayorships', 'area');
		\DBUtil::drop_table('mayorships');
	}
}
