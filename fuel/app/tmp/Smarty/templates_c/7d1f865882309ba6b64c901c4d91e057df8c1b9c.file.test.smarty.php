<?php /* Smarty version Smarty-3.1.19-dev, created on 2014-09-17 02:24:26
         compiled from "/var/www/html/teama/fuel/app/views/test/test.smarty" */ ?>
<?php /*%%SmartyHeaderCode:1878299679541872364daae3-81688860%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d1f865882309ba6b64c901c4d91e057df8c1b9c' => 
    array (
      0 => '/var/www/html/teama/fuel/app/views/test/test.smarty',
      1 => 1410888265,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1878299679541872364daae3-81688860',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19-dev',
  'unifunc' => 'content_5418723650b5f9_74093436',
  'variables' => 
  array (
    'msg' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5418723650b5f9_74093436')) {function content_5418723650b5f9_74093436($_smarty_tpl) {?><html>
<head>
    <title>smarty test</title>
</head>
<body>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<?php $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['val']->step = 1;$_smarty_tpl->tpl_vars['val']->total = (int) ceil(($_smarty_tpl->tpl_vars['val']->step > 0 ? 5+1 - (1) : 1-(5)+1)/abs($_smarty_tpl->tpl_vars['val']->step));
if ($_smarty_tpl->tpl_vars['val']->total > 0) {
for ($_smarty_tpl->tpl_vars['val']->value = 1, $_smarty_tpl->tpl_vars['val']->iteration = 1;$_smarty_tpl->tpl_vars['val']->iteration <= $_smarty_tpl->tpl_vars['val']->total;$_smarty_tpl->tpl_vars['val']->value += $_smarty_tpl->tpl_vars['val']->step, $_smarty_tpl->tpl_vars['val']->iteration++) {
$_smarty_tpl->tpl_vars['val']->first = $_smarty_tpl->tpl_vars['val']->iteration == 1;$_smarty_tpl->tpl_vars['val']->last = $_smarty_tpl->tpl_vars['val']->iteration == $_smarty_tpl->tpl_vars['val']->total;?>
<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
,
<?php }} ?>

</body>
</html>
<?php }} ?>
