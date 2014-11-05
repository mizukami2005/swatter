<?php
class Util_Location {

  public static function get_distance_query($lat, $lng)
  {
    return DB::expr(self::get_distance_formula($lat, $lng) . ' AS distance');
  }

  public static function get_time_query($lat, $lng)
  {
    return DB::expr('ROUND(' . self::get_distance_formula($lat, $lng) . ' / 66.667) AS time');
  }

  protected static function get_distance_formula($lat, $lng)
  {
    return '(((acos(sin((' . (float) $lat . '*pi()/180)) * sin((`latitude`*pi()/180))+cos((' . (float) $lat . '*pi()/180)) * cos((`latitude`*pi()/180)) * cos(((' . (float) $lng . ' - `longitude`)* pi()/180))))*180/pi()) * 60 * 1.1515 * 1.609344 * 1000)';
  }

  protected static function check_str($address,$erea)
  {
    if(strpos($address,$erea) === FALSE){
      return false;
    } else{
      return true;
    }
  }

  protected static function get_area_by_data($data)
  {
    if ( self::check_str($data, "青山") ){
      return 1;
    }elseif( self::check_str($data,"赤坂") ){
      return 2;
    }elseif( self::check_str($data,"六本木") ){
      return 3;
    }elseif( self::check_str($data,"虎ノ門") ){
      return 4;
    }elseif( self::check_str($data,"愛宕") ){
      return 4;
    }elseif( self::check_str($data,"新橋") ){
      return 5;
    }elseif( self::check_str($data,"麻生") ){
      return 6;
    }elseif( self::check_str($data,"芝公園") ){
      return 7;
    }elseif( self::check_str($data,"芝大門") ){
      return 7;
    }elseif( self::check_str($data,"浜松町") ){
      return 7;
    }elseif( self::check_str($data,"海岸") ){
      return 8;
    }elseif( self::check_str($data,"港南") ){
      return 8;
    }elseif( self::check_str($data,"芝浦") ){
      return 8;
    }elseif( self::check_str($data,"芝") ){
      return 9;
    }elseif( self::check_str($data,"三田") ){
      return 9;
    }elseif( self::check_str($data,"白金山") ){
      return 10;
    }elseif( self::check_str($data,"高輪") ){
      return 10;
    }elseif( self::check_str($data,"白金") ){
      return 11;
    }elseif( self::check_str($data,"台場") ){
      return 12;
    }else{
      return false;
    }
  } 

  public static function get_area_by_coordinate($latitude, $longitude)
  {
    $addresses = Dm_Geocoder::reverseGeocode($latitude, $longitude);
    
    for( $i=0; $i<count($addresses); $i++){
      
      $data=$addresses[$i]->localName; 
      
      $area_range = self::get_area_by_data($data);

      if ($area_range){
        return $area_range;
      }
    }

    return false;
    
  }

}
