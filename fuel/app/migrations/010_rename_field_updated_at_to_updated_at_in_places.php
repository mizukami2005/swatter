<?php

namespace Fuel\Migrations;

class Rename_field_updated_at_to_updated_at_in_places
{
	public function up()
	{
		\DBUtil::modify_fields('places', array(
			'updated_at' => array('name' => 'updated_at', 'type' => 'int', 'constraint' => 11, 'null' => true)
		));
	}

	public function down()
	{
	\DBUtil::modify_fields('places', array(
			'updated_at' => array('name' => 'updated_at', 'type' => 'int', 'constraint' => 11)
		));
	}
}
