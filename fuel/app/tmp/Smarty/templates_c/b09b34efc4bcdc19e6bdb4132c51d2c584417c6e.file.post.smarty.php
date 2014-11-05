<?php /* Smarty version Smarty-3.1.19-dev, created on 2014-09-17 16:12:05
         compiled from "/var/www/html/teama/fuel/app/views/swatter/post.smarty" */ ?>
<?php /*%%SmartyHeaderCode:460456229541934456989b7-97764792%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b09b34efc4bcdc19e6bdb4132c51d2c584417c6e' => 
    array (
      0 => '/var/www/html/teama/fuel/app/views/swatter/post.smarty',
      1 => 1410937837,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '460456229541934456989b7-97764792',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19-dev',
  'unifunc' => 'content_541934456d92a5_11135164',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541934456d92a5_11135164')) {function content_541934456d92a5_11135164($_smarty_tpl) {?><!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <?php echo Asset::css('/swatter/default.css');?>

  <?php echo Asset::css('/swatter/common.css');?>

  <?php echo Asset::css('/swatter/post.css');?>

  <title>post</title>
</head>
<body>
  <?php echo $_smarty_tpl->getSubTemplate ('file:swatter/nav-post.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

  <div class="main">
    <div class="post-poster-info">
      <img src="" alt="@4kta">
      <h2>Keita Nakanishi</h2>
      <h3>@4kta</h3> 
    </div>
    <textarea class="post-textarea" placeholder="What's happening?"></textarea>
    <div class="post-toggle">
      <input id="post-toggle-twitter" type="checkbox" name="social" value="twitter" checked="checked">
      <label for="post-toggle-twitter">twitter</label>
    </div>
    <div class="post-footer">
      <ul>
        <li>image</li>
        <li>test</li>
      </ul>
    </div>
    
  </div>
  <script src="//maps.google.com/maps/api/js?sensor=false"></script>
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

</body>
</html>
<?php }} ?>
