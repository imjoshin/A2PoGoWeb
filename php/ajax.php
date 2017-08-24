<?php
require 'utils.php';
require 'constants.php';
require 'functions/account.php';
require 'functions/map.php';
require 'functions/user.php';

if (!isset($_POST['call']))
{
	return;
}

// look for serialized form
if (isset($_POST['form']))
{
	$_POST = array_merge($_POST, unserialize_form($_POST['form']));
}

switch(strtolower($_POST['call']))
{
	case 'login':
		$ret = User::login($_POST['username'], $_POST['password']);
		break;
	case 'logout':
		$ret = User::logout();
		break;
	case 'register':
		$ret = User::register($_POST['username'], $_POST['password'], $_POST['confirm_password'], isset($_POST['invitation_code']) ? $_POST['invitation_code'] : null);
		break;
}

echo json_encode($ret);

function unserialize_form($array)
{
	$data = array();
	foreach(explode('&', $array) as $value)
	{
		$value1 = explode('=', $value);
		$data[$value1[0]] = $value1[1];
	}
	return $data;
}

?>
