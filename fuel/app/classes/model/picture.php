<?php

class Model_Picture extends \Orm\Model
{
  protected static $_belongs_to = array(
    'user',
    'checkin',
  );

	protected static $_properties = array(
		'id',
		'checkin_id',
		'user_id',
		'filepath',
		'filename',
		'extension',
		'mimetype',
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

	protected static $_table_name = 'pictures';

}
