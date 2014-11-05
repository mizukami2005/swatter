<?php /* Smarty version Smarty-3.1.19-dev, created on 2014-09-17 16:11:50
         compiled from "/var/www/html/teama/fuel/app/views/swatter/top.smarty" */ ?>
<?php /*%%SmartyHeaderCode:134391700954193436c9bdc3-68624550%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c6343ffa8e144901542996f9049ded86c33fd9f' => 
    array (
      0 => '/var/www/html/teama/fuel/app/views/swatter/top.smarty',
      1 => 1410937837,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '134391700954193436c9bdc3-68624550',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19-dev',
  'unifunc' => 'content_54193436ce0022_13920607',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54193436ce0022_13920607')) {function content_54193436ce0022_13920607($_smarty_tpl) {?><!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <?php echo Asset::css('/swatter/default.css');?>

  <?php echo Asset::css('/swatter/common.css');?>

  <?php echo Asset::css('/swatter/top.css');?>


  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.css">
  <title>Koshikake</title>
</head>
<body>
  <div class="top-masthead">
    <h1>Koshikake</h1>
    <p>break time for you in downtown</p>
  </div>
  <a class="find-place-button" href="./map">Find place to sit</a>
  <script src="//maps.google.com/maps/api/js?sensor=false"></script>
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.min.js"></script>
</body>
</html>
<?php }} ?>
