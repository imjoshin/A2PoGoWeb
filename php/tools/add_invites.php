<?php
require '../utils.php';

$seed = str_split('ABCDEFGHIJKLMNPQRSTUVWXYZ123456789');

for ($i = 0; $i < intval($argv[1]); $i++)
{
	$code = "";
	foreach (array_rand($seed, 8) as $k)
	{
		$code .= $seed[$k];
	}

	echo $code . "\n";
	db_query("INSERT INTO invitation(code) VALUES (?)", array($code));
}

?>
