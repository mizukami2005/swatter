<?php

class Model_Place extends \Orm\Model
{
  protected static $_has_many = array(
    'checkins',
  );

  protected static $_belongs_to = array(
    'user',
  );

	protected static $_properties = array(
		'id',
		'user_id',
		'latitude',
		'longitude',
		'area',
		'likes',
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

	protected static $_table_name = 'places';

  public function add_like()
  {
    $this->likes += 1;
    $this->save();

    $this->user->add_score($this->area, 5);

    return $this->likes;
  }

  public static function get_page_url($id)
  {
    return 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/swatter/detail?id=' . $id;
  }

  public static function get_picture_url($id)
  {
    return 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/assets/img/swatter/' . $id . '.jpg';
  }

  public static function get_thumbnail_url($id)
  {
    return 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/assets/img/swatter/th/th_' . $id . '.jpg';
  }

  public function bind_info()
  {
    $this->set_url(self::get_page_url($this->id));
    $this->set_picture(self::get_picture_url($this->id));
    $this->set_thumbnail(self::get_thumbnail_url($this->id));
    $this->set_checkins(count($this->checkins));
    $this->set_area(Controller_Swatter::$areas[$this->area]);

    return $this;
  }

}
