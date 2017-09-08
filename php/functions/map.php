<?php

class Map
{
	public static function saveMap($form)
	{
		$name = trim($form['name']);

		if (!preg_match('/[a-zA-Z0-9 ._-]{1,32}$/', $name))
		{
			return array('success'=>false, 'output'=>'Invalid name.');
		}

		$namecheck = db_query("SELECT name FROM map WHERE name = ? AND user_id = ?", array($name, $_SESSION['id']));
		if (count($namecheck))
		{
			return array('success'=>false, 'output'=>"This name is already in use.");
		}

		if (empty($form['start-time']))
		{
			return array('success'=>false, 'output'=>"Enter a valid start time.");
		}

		if (empty($form['end-time']))
		{
			return array('success'=>false, 'output'=>"Enter a valid end time.");
		}

		$days = isset($form['days']) ? implode('', array_map('strtoupper', array_keys($form['days']))) : "";
		$accounts = isset($form['accounts']) ? implode(',', array_keys($form['accounts'])) : "";
		$raids = isset($form['raids']) ? implode(',', array_keys($form['raids'])) : "";

	}
}

?>
