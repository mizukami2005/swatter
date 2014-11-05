<?php
class Controller_Test extends Controller
{
	public function action_index()
	{
		$data = array(
			'msg' => 'SmartyとFuelの連携'
		);

	return Response::forge(View_Smarty::forge('test/test',$data));
	}
}
