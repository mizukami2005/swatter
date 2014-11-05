<?php /* Smarty version Smarty-3.1.19-dev, created on 2014-10-03 12:52:04
         compiled from "/var/www/html/teama/fuel/app/views/swatter/map.smarty" */ ?>
<?php /*%%SmartyHeaderCode:16646444535419343a749809-36327920%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2bfb4250e9aabef97d505a02a2c6d607ef0a773' => 
    array (
      0 => '/var/www/html/teama/fuel/app/views/swatter/map.smarty',
      1 => 1411364405,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16646444535419343a749809-36327920',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19-dev',
  'unifunc' => 'content_5419343a770446_59401437',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5419343a770446_59401437')) {function content_5419343a770446_59401437($_smarty_tpl) {?><!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimal-ui">
  <?php echo Asset::css('/swatter/default.css');?>

  <?php echo Asset::css('/swatter/common.css');?>

  <?php echo Asset::css('/swatter/jquery.custombox.css');?>

  <?php echo Asset::css('/swatter/nav.css');?>

  <?php echo Asset::css('/swatter/map.css');?>

  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.css">
  <title>map</title>
</head>
<body ontouchmove="event.preventDefault()">
  <?php echo $_smarty_tpl->getSubTemplate ('file:swatter/nav.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

  <?php echo $_smarty_tpl->getSubTemplate ('file:swatter/sub-nav.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

  <div class="main">
    <div id="map_canvas"></div>
    <div class="carousel group"></div>
    <div class="map-footer">
      <a href="/swatter/list">リストビュー</a>
    </div>
  </div>
  <button class="modal-dummy-button" style="display: none">aiueo</button>
  <div class="modal-window">
    <h2>loading...</h2>
    <h3>あなたの投稿したエリアのメイヤー</h3>
    <ol>
    </ol>
    <div id="loading"></div>
  </div>

  <script src="//maps.google.com/maps/api/js?sensor=false"></script>
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <?php echo Asset::js('/swatter/map.js');?>

  <?php echo Asset::js('/swatter/location_util.js');?>

  <script src="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.min.js"></script>
  <?php echo Asset::js('/swatter/jquery.custombox.js');?>

  <script>
    $(function() {
      function getQueryVariable(variable) {
        var query = window.location.search.substring(1),
        vars = query.split("&");

        for (var i = 0; i < vars.length; i++) {
          var pair = vars[i].split("=");
          if (pair[0] == variable) {
            return pair[1];
          }
        }
        return false;
      }

      $('.carousel').slick({
        centerMode: true,
        arrows: false
      });

      $('.modal-dummy-button').on('click', function(e) {
        $.fn.custombox(this, {
          url: '.modal-window',
          effect: 'fadein',
          responsive: true
        });
        e.preventDefault();
      });

      if (getQueryVariable('mayor_area')) {

        var mayor_area = getQueryVariable('mayor_area');
        
        window.location_util.get_mayors_by_area(function(data) {
          $('#loading').hide();
          $('.modal-window > ol').empty();
          for (var key in data) {
            $('.modal-window > h2').html(data[key].area.name);
            $('.modal-window > ol').append(
              $('<li/>').append(
                $('<ul/>').addClass('group').append(
                  $('<li/>').append(
                    $('<span/>').addClass('mayor-rank').text('#' + data[key].rank)
                  ),
                  $('<li/>').append(
                    $('<img/>').addClass('mayor-thumbnail').attr('src', data[key].user.profile_image)
                  ),
                  $('<li/>').append(
                    $('<h4/>').addClass('mayor-name').text('@' + data[key].user.screen_name)
                  )
                )
              )
            );
          }
        }, mayor_area);
        
        $('.modal-dummy-button').trigger('click');
      }
    });
  </script>
</body>
</html>
<?php }} ?>
