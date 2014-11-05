<?php

class Model_Score extends \Orm\Model
{
  protected static $_belongs_to = array(
    'user',
  );

	protected static $_properties = array(
		'id',
		'user_id',
		'area',
		'date',
		'score',
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

	protected static $_table_name = 'scores';

}
