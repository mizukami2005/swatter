<?php

namespace Fuel\Migrations;

class Add_likes_to_places
{
	public function up()
	{
		\DBUtil::add_fields('places', array(
			'likes' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true, 'default' => 0),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('places', array(
			'likes'
		));
	}
}
