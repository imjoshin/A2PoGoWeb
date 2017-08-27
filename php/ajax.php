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

session_start();
if (!isset($_SESSION['id']) && !in_array(strtolower($_POST['call']), array("login", "register")))
{
	return json_encode(array("success"=>false, "output"=>"Session expired. Please refresh."));
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
	case 'verify':
		$ret = Account::sendVerificationCode($_POST);
		break;
	case 'add_account':
		$ret = Account::addAccount($_POST);
		break;
}

echo json_encode($ret);

?>
