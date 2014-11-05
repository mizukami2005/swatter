<?php

class Model_User extends \Orm\Model
{
  protected static $_has_many = array(
    'checkins',
    'places',
    'pictures',
    'scores',
  );

	protected static $_properties = array(
		'id',
		'tw_id',
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

	protected static $_table_name = 'users';

  public static function update_mayorship($area) {
    $query = DB::select('user_id', DB::expr('SUM(score) AS sum'))->from('scores')->where('area', $area)->where('date', '>', DB::expr('DATE_ADD(CURRENT_DATE(), INTERVAL -5 DAY)'))->group_by('user_id')->order_by('sum', 'desc')->limit(3);
    Log::warning($query->compile());
    $data = $query->execute();
    for ($i = 0; $i < 3; $i++) {
      if ($data[$i]) {
        $mayorship = Model_Mayorship::find('first', array(
          'where' => array(
            array('area', $area),
            array('rank', $i + 1),
          )
        ));
        if (is_null($mayorship)) { // メイヤーシップがなければ作成
          $mayorship = new Model_Mayorship;
          $mayorship->area = $area;
          $mayorship->rank = $i + 1;
        }
        if ($mayorship->user_id !== $data[$i]['user_id']) { // 順位が変わっていれば更新する
          $mayorship->user_id = $data[$i]['user_id'];
          $mayorship->save();
        }
      }
    }
  }

  public function add_score($area, $amount) {
    $score = Model_Score::find('first', array(
      'where' => array(
        array('user_id', $this->id),
        array('area', $area),
        array('date', DB::expr('CURRENT_DATE()')),
      )
    ));
    if (is_null($score)) {
      $score = new Model_Score;
      $score->user_id = $this->id;
      $score->score = $amount;
      $score->date = DB::expr('CURRENT_DATE()');
      $score->area = $area;
    } else {
      $score->score += $amount;
    }
    $score->save();
    self::update_mayorship($area);
  }

  public function bind_info()
  {
    $tw = new TwitterOAuth($_SERVER['TWITTER_CONSUMER_KEY'], $_SERVER['TWITTER_CONSUMER_SECRET'], $_SERVER['TWITTER_ACCESS_TOKEN'], $_SERVER['TWITTER_ACCESS_TOKEN_SECRET']);
    $tw->host = 'https://api.twitter.com/1.1/';
    $profile = $tw->get('users/show', array(
        'id' => $this->tw_id
    ));
    $this->set_name($profile->name);
    $this->set_screen_name($profile->screen_name);
    $this->set_profile_image($profile->profile_image_url_https);
  }

}
