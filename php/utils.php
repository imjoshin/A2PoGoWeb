<?php
require 'auth.php';

function init()
{
	return array("accounts"=>getAccounts(), "maps"=>getMaps());
}

function formatAccount($account)
{
	$newAccount = array();
	$extra = json_decode($account['extra']);
	$newAccount['id'] = $account['id'];
	$newAccount['name'] = $account['name'];
	$newAccount['type'] = $account['type'];
	$newAccount['pokemon-format'] = $account['pokemon_format'];
	$newAccount['raid-format'] = $account['raid_format'];
	$newAccount['icon'] = "fa-question-circle-o";

	switch ($account['type'])
	{
		case 'email':
			$newAccount['address'] = $account['address'];
			$newAccount['icon'] = 'fa-envelope-o';
			$newAccount['detail'] = $account['address'];
			break;
		case 'phone':
			$address = explode('@', $account['address']);
			$newAccount['number'] = $address[0];
			$newAccount['carrier'] = $address[1];
			$newAccount['icon'] = 'fa-mobile';
			$newAccount['detail'] = "(" . substr($address[0], 0, 3) . ") " . substr($address[0], 3, 3) . "-" . substr($address[0], 6);
			break;
		case 'discord':
			$newAccount['webhook'] = $account['address'];
			$newAccount['channel'] = $extra->channel;
			$newAccount['pokemon-user'] = $extra->pokemon_user;
			$newAccount['raid-user'] = $extra->raid_user;
			$newAccount['icon'] = 'fa-user-circle';
			$newAccount['detail'] = $extra->channel;
			break;
		case 'slack':
			$newAccount['webhook'] = $account['address'];
			$newAccount['channel'] = $extra->channel;
			$newAccount['pokemon-user'] = $extra->pokemon_user;
			$newAccount['raid-user'] = $extra->raid_user;
			$newAccount['icon'] = 'fa-slack';
			$newAccount['detail'] = $extra->channel;
			break;
	}

	return $newAccount;
}

function getAccounts($includeTemplate = true)
{
	$accounts = db_query("SELECT * FROM account WHERE user_id = ?", array($_SESSION['id']));
	$returnAccounts = array();

	foreach ($accounts as $account)
	{
		$returnAccounts[] = formatAccount($account);
	}

	if ($includeTemplate)
	{
		$returnAccounts[] = array(
			'id' => -1,
			'name' => '',
			'icon' => '',
			'detail' => ''
		);
	}

	return $returnAccounts;
}

function formatMap($map)
{
	$newMap = array();
	$newMap['id'] = $map['id'];
	$newMap['name'] = $map['name'];
	$newMap['start-time'] = $map['start_time'];
	$newMap['end-time'] = $map['end_time'];
	$newMap['pokemon'] = $map['pokemon'];

	if (strpos($map['days'], ",") === false)
	{
		$newMap["days[{$map['days']}]"] = "on";
	}
	else
	{
		foreach(explode(',', $map['days']) as $day)
		{
			$newMap["days[{$day}]"] = "on";
		}
	}

	if (strpos($map['accounts'], ",") === false)
	{
		$newMap["accounts[{$map['accounts']}]"] = "on";
	}
	else
	{
		foreach(explode(',', $map['accounts']) as $account)
		{
			$newMap["accounts[{$account}]"] = "on";
		}
	}

	if (strpos($map['raids'], ",") === false)
	{
		$newMap["raids[{$map['raids']}]"] = "on";
	}
	else
	{
		foreach(explode(',', $map['raids']) as $raid)
		{
			$newMap["raids[{$raid}]"] = "on";
		}
	}

	if (strlen($map['days']) > 0 && preg_match('/\\d/', $map['days']))
	{
		$newMap["detail"] = formatDays($map['days']) . " / " . strtoupper(date("g:i a", strtotime($map["start_time"])) . ' - ' . date("g:i a", strtotime($map["end_time"])));
	}
	else
	{
		$newMap["detail"] = "No active days";
	}

	$icon = "fa-map-o";
	if (in_array(date('N', strtotime(date('l'))), explode(',', $map['days'])))
	{
		$now = new DateTime();
		$start = new DateTime($map['start_time']);
		$end = new DateTime($map['end_time']);

		if ($start <= $now && $now <= $end)
		{
			$icon = "fa-map";
		}
	}

	$newMap['icon'] = $icon;
	return $newMap;
}

function getMaps($includeTemplate = true)
{
	$maps = db_query("SELECT * FROM map WHERE user_id = ?", array($_SESSION['id']));
	$returnMaps = array();

	foreach ($maps as $map)
	{
		$returnMaps[] = formatMap($map);
	}

	if ($includeTemplate)
	{
		$returnMaps[] = array(
			'id' => -1,
			'name' => '',
			'icon' => '',
			'detail' => ''
		);
	}

	return $returnMaps;
}

function formatDays($days)
{
	$names = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
	if (strpos($days, ",") === false)
	{
		$days .= ",";
	}

	$daysArr = explode(',', $days);

	if (count($daysArr) == 7)
	{
		return "Daily";
	}

	if (count($daysArr) == 5 && in_array(1, $daysArr) && in_array(2, $daysArr) && in_array(3, $daysArr) && in_array(4, $daysArr) && in_array(5, $daysArr))
	{
		return "Weekdays";
	}

	if (count($daysArr) == 2 && in_array(6, $daysArr) && in_array(7, $daysArr))
	{
		return "Weekends";
	}

	$ret = array();
	foreach($daysArr as $day)
	{
		$ret[] = $names[intval($day) - 1];
	}
	return implode(", ", $ret);
}

function unserialize_form($array)
{
	$data = array();
	foreach(explode('&', $array) as $value)
	{
		$value1 = explode('=', $value);
		$key = urldecode($value1[0]);
		$value = urldecode($value1[1]);
		if (preg_match('/\[.+\]/', $key, $match))
		{
			$arrayName = str_replace($match[0], '', $key);
			$arrayKey = str_replace(array('[', ']'), '', $match[0]);

			if (!isset($data[$arrayName]))
			{
				$data[$arrayName] = array();
			}

			$data[$arrayName][$arrayKey] = $value;
		}
		else
		{
			$data[$key] = $value;
		}
	}

	return $data;
}

/*
 * Returns a database connection
 */
function db_connect()
{
	$result = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

	if(!$result)
	{
		throw new Exception('Could not connect to db server');
	}

	return $result;
}

/*
 * Executes a prepared statement against the database
 *
 * @param string $query  The query to Executes
 * @param array  $params An array of parameters to bind
 * @return array Matching rows in an array
 */
function db_query($query, $params = null)
{
	$mysqli = db_connect();
	$stmt = $mysqli->prepare($query);

	if ($params)
	{
		$bind_params = array();
		$types = "";

		foreach ($params as $i=>$param)
		{
			$bind_params[] = &$params[$i];

			if (is_float($param))
			{
				$types .= "d";
			}
			elseif (is_int($param))
			{
				$types .= "i";
			}
			else
			{
				$types .= "s";
			}
		}

		array_unshift($params, $types);

		call_user_func_array(array($stmt, 'bind_param'), $params);
	}

	$stmt->execute();
	$res = $stmt->get_result();
	$result = array();

	if (is_bool($res))
	{
		return $res;
	}

	while ($row = mysqli_fetch_assoc($res))
	{
		$result[] = $row;
	}

	$stmt->close();
	return $result;
}

?>
