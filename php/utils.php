<?php
require 'auth.php';

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