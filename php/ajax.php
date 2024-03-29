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

if (!isset($_SESSION['id']) && !in_array(strtolower($_POST['call']), array("login", "register", "check")))
{
	$ret = array("success"=>false, "output"=>array(
		"message"=>"Session expired. Please refresh."
	));
	return json_encode($ret);
}

// look for serialized form
if (isset($_POST['form']))
{
	$_POST = array_merge($_POST, unserialize_form($_POST['form']));
	unset($_POST['form']);
}

switch(strtolower($_POST['call']))
{
	case 'check':
		$ret = array("success"=>true, "output"=>array(
			"expired"=>(!isset($_SESSION['id']) || (isset($_POST['user']) && $_SESSION['id'] != $_POST['user'])),
			"user"=>$_SESSION['id']
		));
		break;
	case 'login':
		error_log("logout");
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
	case 'save_account':
		$ret = Account::saveAccount($_POST);
		break;
	case 'delete_account':
		$ret = Account::deleteAccount($_POST['id']);
		break;
	case 'save_map':
		$ret = Map::saveMap($_POST);
		break;
	case 'delete_map':
		$ret = Map::deleteMap($_POST['id']);
		break;
}

echo json_encode($ret);

?>
