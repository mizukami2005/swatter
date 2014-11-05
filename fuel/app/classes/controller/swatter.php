<?php
require_once(dirname(__FILE__) . '/../lib/twitteroauth/twitteroauth.php');
require_once dirname(__FILE__) . '/../util/location.php';

class Controller_Swatter extends Controller_Rest
{

  public static $areas = array(
    1 => array(
      'id' => 1,
      'name' => '青山',
      'name_alp' => 'Aoyama'
    ),
    2 => array(
      'id' => 2,
      'name' => '赤坂',
      'name_alp' => 'Akasaka'
    ),
    3 => array(
      'id' => 3,
      'name' => '六本木',
      'name_alp' => 'Roppongi'
    ),
    4 => array(
      'id' => 4,
      'name' => '虎ノ門',
      'name_alp' => 'Toranomon'
    ),
    5 => array(
      'id' => 5,
      'name' => '新橋',
      'name_alp' => 'Shimbashi'
    ),
    6 => array(
      'id' => 6,
      'name' => '麻布',
      'name_alp' => 'Azabu'
    ),
    7 => array(
      'id' => 7,
      'name' => '浜松町',
      'name_alp' => 'Hamamatsu-cho'
    ),
    8 => array(
      'id' => 8,
      'name' => '芝浦',
      'name_alp' => 'Shibaura'
    ),
    9 => array(
      'id' => 9,
      'name' => '田町',
      'name_alp' => 'Tamachi'
    ),
    10 => array(
      'id' => 10,
      'name' => '白金高輪',
      'name_alp' => 'Shirokane-takanawa'
    ),
    11 => array(
      'id' => 11,
      'name' => '白金',
      'name_alp' => 'Shirokane'
    ),
    12 => array(
      'id' => 12,
      'name' => '台場',
      'name_alp' => 'Daiba'
    ),
  );

  protected $rest_format = 'json';

  public function action_map()
  {
      return Response::forge(View_Smarty::forge('swatter/map.smarty'));
  }

  public function action_list()
  {
      return Response::forge(View_Smarty::forge('swatter/list.smarty'));
  }

  public function action_post()
  {
    if (is_null(Session::get('oauth_token')) || is_null(Session::get('oauth_token_secret')) || is_null( Session::get('tw_id'))) {
      Response::redirect('/swatter/signin?redirect_path=swatter/post');
    }

    $tw = new TwitterOAuth($_SERVER['TWITTER_CONSUMER_KEY'], $_SERVER['TWITTER_CONSUMER_SECRET'], Session::get('oauth_token'), Session::get('oauth_token_secret'));
    $data = $tw->get('users/show', array('user_id' => Session::get('tw_id')));
    $user = array(
      'screen_name' => $data->screen_name,
      'name' => $data->name,
      'profile_image' => $data->profile_image_url_https,
    );
    return Response::forge(View_Smarty::forge('swatter/post.smarty', array(
      'user' => $user
    )));
  }

  public function action_detail()
  {
      return Response::forge(View_Smarty::forge('swatter/detail.smarty'));
  }

  public function action_get_nearby_places()
  {
    $latitude = $_GET['latitude'];
    $longitude = $_GET['longitude'];
    $radius = $_GET['radius'];

    // FuelPHP のバグ(？)により、as_object() での取得を実現できないので、新しく生成したモデルの配列を返す
    $query_builder = DB::select('id', 'latitude', 'longitude', 'likes', 'area', Util_Location::get_distance_query($latitude, $longitude), Util_Location::get_time_query($latitude, $longitude), 'checkins')->from('places')->distinct(true)->having('distance', '<', $radius)->join(DB::expr('(SELECT COUNT(*) AS CHECKINS, PLACE_ID FROM checkins GROUP BY place_id) AS chkin_tbl'), 'left')->on('places.id', '=', 'chkin_tbl.checkins')->order_by('distance')->limit(20);
    $data = $query_builder->execute()->as_array();

    $places = array();

    foreach ($data as $record) {
      $place = new Model_Place;
      $place->set_id((int) $record['id']);
      $place->set_latitude((float)$record['latitude']);
      $place->set_longitude((float) $record['longitude']);
      $place->set_likes((int) $record['likes']);
      $place->set_checkins((int) $record['checkins']);
      $place->set_area((int)$record['area']);
      $place->set_distance(round($record['distance']));
      $place->set_time((int) $record['time']);
      $places[] = $place->bind_info();
    }

    if (count($places) > 0) {
      return $this->response($places);
    } else {
      return $this->response(new stdClass);
    }
  }

  public function action_get_place_information()
  {
    $id = $_GET['id'];
    if (isset($_GET['latitude'], $_GET['longitude'])) {
      $latitude = $_GET['latitude'];
      $longitude = $_GET['longitude'];
      $query = DB::select('id', 'user_id', 'latitude', 'longitude', 'area', 'likes', Util_Location::get_distance_query($latitude, $longitude), Util_Location::get_time_query($latitude, $longitude))->from('places')->where('id', $id)->as_object('Model_Place');
    } else {
      $query = DB::select('id', 'user_id', 'latitude', 'longitude', 'area', 'likes')->from('places')->where('id', $id)->as_object('Model_Place');
    }

    $place = $query->execute()->current();

    if (is_null($place)) {
      $this->response(null, 404);
    }

    // ページビュー 1ポイント加算
    $user = Model_User::find($place->user_id);
    $user->add_score($place->area, 1);

    $this->response($place->bind_info());
  }

  public function action_get_mayors_by_area()
  {
    $area = $_GET['area'];
    $mayors = Model_Mayorship::find_by('area', $area);
    if (empty($mayors)) {
      Model_User::update_mayorship($area);
    }
    $mayors = Model_Mayorship::find_by('area', $area);

    $ret_val = array();

    foreach ($mayors as $mayor) {
      $ret_val[] = $mayor->bind_info();
    }

    if (empty($ret_val)) {
      $this->response(new stdClass);
    } else {
      $this->response($ret_val);
    }
  }

  public function action_get_area_by_location()
  {
    $latitude = $_GET['latitude'];
    $longitude = $_GET['longitude'];
    $area = Util_Location::get_area_by_coordinate($latitude, $longitude);
    $this->response(self::$areas[$area]);
  }

  public function action_signin()
  {
    // Twitter 認証後のリダイレクト先を保存
    $redirect_path = isset($_GET['redirect_path']) ? $_GET['redirect_path'] : '/';
    Session::set('sign_in_redirect_path', $_GET['redirect_path']);

    // request token取得
    $tw = new TwitterOAuth($_SERVER['TWITTER_CONSUMER_KEY'], $_SERVER['TWITTER_CONSUMER_SECRET']);

    $callback_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/swatter/callback';
    $token = $tw->getRequestToken($callback_url);

    if(! isset($token['oauth_token'])){
      echo "error: getRequestToken\n";
      exit;
    }

    // sessionに保存
    Session::set('oauth_token',$token['oauth_token']);
    Session::set('oauth_token_secret',$token['oauth_token_secret']);

    // 認証用URL取得してredirect
    $authURL = $tw->getAuthorizeURL(Session::get('oauth_token'));
    header("Location: " . $authURL);
  }

  public function action_callback()
  {
    // oauth_token と一致するかチェック
    if (Session::get('oauth_token') !== $_REQUEST['oauth_token']) {
      Session::delete('oauth_token');
      Session::delete('oauth_token_secret');
      echo '<a href="getToken.php">different token</a>';
      exit;
    }

    $tw = new TwitterOAuth($_SERVER['TWITTER_CONSUMER_KEY'], $_SERVER['TWITTER_CONSUMER_SECRET'], Session::get('oauth_token'), Session::get('oauth_token_secret'));

    // ユーザー情報の保存
    $access_token = $tw->getAccessToken($_REQUEST['oauth_verifier']);
    $tw_id = $access_token['user_id'];
    $existing_user = Model_User::find_by('tw_id', $tw_id);
    if (count($existing_user) === 0) {
      $user = new Model_User();
      $user->tw_id = $tw_id;
      $user->save();
    }
    Session::set('tw_id', $tw_id);
    Session::set('oauth_token', $access_token['oauth_token']);
    Session::set('oauth_token_secret', $access_token['oauth_token_secret']);

    // セッションで保存されたパスにリダイレクト
    $redirect_path = Session::get('sign_in_redirect_path');
    Session::delete('sign_in_redirect_path');
    Response::redirect($redirect_path);
  }

  public function post_checkin()
  {
    if (is_null(Session::get('oauth_token')) || is_null(Session::get('oauth_token_secret')) || is_null( Session::get('tw_id'))) {
      $this->response('', 401);
    }

    $score = 0;

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $accuracy = $_POST['accuracy'];
    $message = $_POST['message'];

    // ユーザー情報を取得
    $tw_id = Session::get('tw_id');
    $users = Model_User::find_by('tw_id', $tw_id);
    $user = reset($users);

    // 近くの場所の検索
    $query = DB::select('id', 'area', Util_Location::get_distance_query($latitude, $longitude))->from('places')->having('distance', '<', $accuracy)->order_by('distance')->as_object('Model_Place');
    $place = $query->execute()->current();

    DB::start_transaction();

    // 近くの場所が存在すれば一番近い場所にチェックイン
    if (!is_null($place)) {
      $area = $place->area;
      $score += 10;
    } else { // そうでなければ新しい場所を作成
      $area = Util_Location::get_area_by_coordinate($latitude, $longitude);

      $place = new Model_Place();
      $place->user_id = $user->id;
      $place->latitude = $latitude;
      $place->longitude = $longitude;
      $place->area = $area;
      $place->likes = 0;
      $place->save();
      $score += 20;
    }

    $checkin = new Model_Checkin();
    $checkin->user_id = $user->id;
    $checkin->place_id = $place->id;
    $checkin->latitude = $latitude;
    $checkin->longitude = $longitude;
    $checkin->accuracy = $accuracy;
    $checkin->message = $message;
    $checkin->save();

    if (isset($_POST['post_to_twitter_flg'])) {
      $score += 10;
    }

    $user->add_score($area, $score);

    DB::commit_transaction();

    if (isset($_POST['post_to_twitter_flg'])) { // Twitter に投稿
      $tw = new TwitterOAuth($_SERVER['TWITTER_CONSUMER_KEY'], $_SERVER['TWITTER_CONSUMER_SECRET'], Session::get('oauth_token'), Session::get('oauth_token_secret'));
      $tw->host = 'https://api.twitter.com/1.1/';
      $url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/swatter/detail?id=' . $place->id;
      if (empty($message)) {
        $parameters['status'] = $message . ' | 座れる場所を見つけました! ' . $url . ' #koshikake';
      } else {
        $parameters['status'] = $message . ' ' . $url . ' #koshikake';
      }
      $status = $tw->post('statuses/update', $parameters);
    }

    $data = new stdClass;
    $data->redirect_path = '/swatter/map?mayor_area=' . $area;
    $this->response($data);
  }

  public function post_add_like()
  {
    $place_id = $_POST['place_id'];
    $place = Model_Place::find($place_id);
    if (is_null($place)) {
      $error = new stdClass;
      $error->errors = 'record_not_found';
      $this->response($errors, 404);
    } else {
      $place->add_like();
      $this->response($place->bind_info());
    }
  }

}
