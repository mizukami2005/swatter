<?php
/**
 *  * The production database settings. These get merged with the global settings.
 *   */

return array(
  'default' => array(
    'connection'  => array(
      'dsn'        => 'mysql:host=' . $_SERVER['DATABASE_ADDRESS'] . ';dbname=swatter',
      'username'   => 'swatter',
      'password'   =>  $_SERVER['DATABASE_PASSWORD'] ,
    ),
  ),
);
