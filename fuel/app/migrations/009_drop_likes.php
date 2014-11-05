<?php

namespace Fuel\Migrations;

class Drop_likes
{
	public function up()
	{
		\DBUtil::drop_table('likes');
	}

	public function down()
	{
		\DBUtil::create_table('likes', array(
			'id' => array('type' => 'int unsigned', 'null' => true, 'auto_increment' => true),
			'place_id' => array('type' => 'int unsigned', 'null' => true),
			'created_at' => array('type' => 'int', 'null' => true, 'constraint' => 11),
			'updated_at' => array('type' => 'int', 'null' => true, 'constraint' => 11),

		), array('id'));
		\DB::query("CREATE INDEX place_id_idx ON likes (`place_id`)")->execute();

	}
}
