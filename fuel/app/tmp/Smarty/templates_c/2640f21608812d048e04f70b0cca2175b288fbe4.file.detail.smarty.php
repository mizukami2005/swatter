<?php /* Smarty version Smarty-3.1.19-dev, created on 2014-11-05 22:36:29
         compiled from "/var/www/html/teama/fuel/app/views/swatter/detail.smarty" */ ?>
<?php /*%%SmartyHeaderCode:4671695665418f7e624f431-15341156%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2640f21608812d048e04f70b0cca2175b288fbe4' => 
    array (
      0 => '/var/www/html/teama/fuel/app/views/swatter/detail.smarty',
      1 => 1411364405,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4671695665418f7e624f431-15341156',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19-dev',
  'unifunc' => 'content_5418f7e627a705_93084263',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5418f7e627a705_93084263')) {function content_5418f7e627a705_93084263($_smarty_tpl) {?><!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimal-ui">
  <?php echo Asset::css('/swatter/default.css');?>

  <?php echo Asset::css('/swatter/common.css');?>

  <?php echo Asset::css('/swatter/nav.css');?>

  <?php echo Asset::css('/swatter/detail.css');?>

  <title>detail</title>
</head>
<body>
  <div class="nav">
    <h1>loading... </h1>
    <span class="nav-bar-left">
      <a href="">
        <?php echo Asset::img('swatter/back-button.png');?>

      </a>
    </span>
    <span class="nav-bar-right"></span>
  </div>
  <div class="main">
    <div class="detail-header">
      <div class="header-image-wrapper">
        <img src="">
        <div class="detail-header-shadow">
          <ul class="chair-info">
            <li class="time-and-distance">- 分 ( - m )</li>
            <li class="checkins">- check-in</li>
            <li class="likes">- likes</li>
          </ul>
        </div>
      </div>
    </div>
    <button class="like-button">
      Like?
    </button>
    <a class="add-map-style" href=""></a>
    <div id="map_canvas"></div>
    <div id="navigation_canvas"></div>
  </div>
  <div id="loading"></div>
  <script src="//maps.google.com/maps/api/js?sensor=false"></script>
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <?php echo Asset::js('/swatter/location_util.js');?>

  <?php echo Asset::js('/swatter/detail.js');?>

  <script>
    $(function() {
      $('.nav-bar-left a').attr('href', document.referrer); 
    });
  </script>
</body>
</html>
<?php }} ?>
