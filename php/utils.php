<?php
require 'auth.php';

function init()
{
	$accounts = db_query("SELECT id, name, address, type FROM account WHERE user_id = ?", array($_SESSION['id']));
	$maps = db_query("SELECT id, name FROM map WHERE user_id = ?", array($_SESSION['id']));

	foreach ($accounts as &$account)
	{
		$icon = "fa-question-circle-o";
		switch ($account['type'])
		{
			case 'phone':
				$icon = 'fa-mobile';
				break;
			case 'email':
				$icon = 'fa-envelope-o';
				break;
			case 'slack':
				$icon = 'fa-slack';
				break;
			case 'discord':
				$icon = 'fa-user-circle';
				break;
		}
		$account['icon'] = $icon;
	}

	return array("accounts"=>$accounts, "maps"=>$maps);
}

function unserialize_form($array)
{
	$data = array();
	foreach(explode('&', $array) as $value)
	{
		$value1 = explode('=', $value);
		$data[urldecode($value1[0])] = urldecode($value1[1]);
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
