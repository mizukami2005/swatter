<?php

namespace Fuel\Migrations;

class Create_scores
{
	public function up()
	{
		\DBUtil::create_table('scores', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'area' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'date' => array('type' => 'date'),
			'score' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
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
    \DBUtil::create_index('scores', 'area');
    \DBUtil::create_index('scores', 'date');
	}

	public function down()
	{
    \DBUtil::drop_index('scores', 'date');
		\DBUtil::drop_table('scores');
	}
}
