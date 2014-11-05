<?php

class Model_Mayorship extends \Orm\Model
{
  protected static $_belongs_to = array(
    'user',
  );

	protected static $_properties = array(
		'id',
		'user_id',
		'area',
		'rank',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'mayorships';

  public function bind_info()
  {
    $this->user->bind_info();
    $this->set_area(Controller_Swatter::$areas[$this->area]);
    return $this;
  }

}
