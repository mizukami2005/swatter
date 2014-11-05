<?php

class Model_Checkin extends \Orm\Model
{
  protected static $_belongs_to = array(
    'user',
    'place',
  );

	protected static $_properties = array(
		'id',
		'user_id',
		'place_id',
		'latitude',
		'longitude',
		'accuracy',
		'message',
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

	protected static $_table_name = 'checkins';

}
