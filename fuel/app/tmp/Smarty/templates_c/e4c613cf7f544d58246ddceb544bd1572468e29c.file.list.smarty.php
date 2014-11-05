<?php /* Smarty version Smarty-3.1.19-dev, created on 2014-10-03 12:52:21
         compiled from "/var/www/html/teama/fuel/app/views/swatter/list.smarty" */ ?>
<?php /*%%SmartyHeaderCode:13505474525419dea7293954-78703748%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4c613cf7f544d58246ddceb544bd1572468e29c' => 
    array (
      0 => '/var/www/html/teama/fuel/app/views/swatter/list.smarty',
      1 => 1411364405,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13505474525419dea7293954-78703748',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19-dev',
  'unifunc' => 'content_5419dea72f3874_51039978',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5419dea72f3874_51039978')) {function content_5419dea72f3874_51039978($_smarty_tpl) {?><!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimal-ui">
  <?php echo Asset::css('/swatter/default.css');?>

  <?php echo Asset::css('/swatter/common.css');?>

  <?php echo Asset::css('/swatter/nav.css');?>

  <?php echo Asset::css('/swatter/list.css');?>

  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.css">
  <title>map</title>
</head>
<body>
  <?php echo $_smarty_tpl->getSubTemplate ('file:swatter/nav.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

  <?php echo $_smarty_tpl->getSubTemplate ('file:swatter/sub-nav.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

  <div class="main">
    <ul class="chair-list">
    </ul>
    <div class="map-footer">
      <a href="/">マップビュー</a>
    </div>
  </div>
  <div id="loading"></div>
  <script src="//maps.google.com/maps/api/js?sensor=false"></script>
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.min.js"></script>
  <?php echo Asset::js('/swatter/location_util.js');?>

  <?php echo Asset::js('/swatter/list.js');?>

</body>
<?php }} ?>
