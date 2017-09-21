<?php

class Map
{
	public static function saveMap($form)
	{
		$name = trim($form['name']);

		if (!preg_match('/[a-zA-Z0-9 ._-]{1,32}$/', $name))
		{
			return array('success'=>false, 'output'=>array(
				"message"=>'Invalid name.'
			));
		}

		if ($form['new'])
		{
			$namecheck = db_query("SELECT name FROM map WHERE name = ? AND user_id = ?", array($name, $_SESSION['id']));
		}
		else
		{
			$namecheck = db_query("SELECT name FROM map WHERE name = ? AND user_id = ? AND id != ?", array($name, $_SESSION['id'], $form['id']));
		}

		if (count($namecheck))
		{
			return array('success'=>false, 'output'=>array(
				"message"=>"This name is already in use."
			));
		}

		if (empty($form['start-time']))
		{
			return array('success'=>false, 'output'=>array(
				"message"=>"Enter a valid start time."
			));
		}

		$start = new DateTime($form['start-time']);
		$end = new DateTime($form['end-time']);

		if (empty($form['end-time']) || $start >= $end)
		{
			return array('success'=>false, 'output'=>array(
				"message"=>"Enter a valid end time."
			));
		}

		$days = isset($form['days']) ? implode(',', array_keys($form['days'])) : "";
		$accounts = isset($form['accounts']) ? implode(',', array_keys($form['accounts'])) : "";
		$raids = isset($form['raids']) ? implode(',', array_keys($form['raids'])) : "";
		$raidEggs = isset($form['raid-eggs']) ? implode(',', array_keys($form['raid-eggs'])) : "";

		if ($form['new'])
		{
			db_query("INSERT INTO map(user_id, name, accounts, pokemon, raids, raid_eggs, days, boundaries, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($_SESSION['id'], $name, $accounts, $form['pokemon-selected'], $raids, $raidEggs, $days, $form['boundaries'], $form['start-time'], $form['end-time']));
			$map = db_query("SELECT * FROM map WHERE name = ? AND user_id = ?", array($name, $_SESSION['id']));
		}
		else
		{
			db_query("UPDATE map SET name = ?, accounts = ?, pokemon = ?, raids = ?, raid_eggs = ?, days = ?, boundaries = ?, start_time = ?, end_time = ? WHERE id = ? AND user_id = ? ", array($name, $accounts, $form['pokemon-selected'], $raids, $raidEggs, $days, $form['boundaries'], $form['start-time'], $form['end-time'],$form['id'], $_SESSION['id']));
			$map = db_query("SELECT * FROM map WHERE id = ? AND user_id = ?", array($form['id'], $_SESSION['id']));
		}

		return array("success"=>true, "output"=>array(
			"fields"=>formatMap($map[0]),
			"new"=>($form['new'] ? true : false)
		));
	}
}

?>
