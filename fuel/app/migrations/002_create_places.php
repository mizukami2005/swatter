<?php

namespace Fuel\Migrations;

class Create_places
{
  public function up()
  {
    \DBUtil::create_table('places', array(
      'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
      'user_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
      'latitude' => array('constraint' => '9,7', 'type' => 'float'),
      'longitude' => array('constraint' => '10,7', 'type' => 'float'),
      'area' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
      'created_at' => array('constraint' => 11, 'type' => 'int'),
      'updated_at' => array('constraint' => 11, 'type' => 'int'),

    ), array('id'), true, 'InnoDB', null, array(
      array(
        'key' => 'user_id',
        'reference' => array(
          'table' => 'users',
          'column' => 'id'
        )
      )
    ));
    \DBUtil::create_index('places', 'area');
  }

  public function down()
  {
    \DBUtil::drop_index('places', 'area');
    \DBUtil::drop_table('places');
  }
}
