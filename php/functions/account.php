<?php

class Account
{
	public static function sendVerificationCode($form)
	{
		$address = trim($form['address']);

		if ($form['type'] === "Phone")
		{
			$number = str_replace(array('(', ')', ' ', '-',), '', $form['number']);
			if (!is_numeric($number) || strlen($number) != 10)
			{
				return array('success'=>false, 'output'=>array(
					"message"=>"Invalid phone number."
				));
			}
			$address = $number . "@" . $form['carrier'];
		}

		if (!filter_var($address, FILTER_VALIDATE_EMAIL))
		{
			return array('success'=>false, 'output'=>array(
				"message"=>"Invalid address."
			));
		}

		$namecheck = db_query("SELECT name FROM account WHERE address = ? AND user_id = ?", array($address, $_SESSION['id']));
		if (count($namecheck))
		{
			return array('success'=>false, 'output'=>array(
				"message"=>"This address is already in use."
			));
		}

		$usercheck = db_query("SELECT address FROM verification WHERE address = ? AND user_id = ?", array($address, $_SESSION['id']));
		if (count($usercheck))
		{
			return array('success'=>false, 'output'=>array(
				"message"=>"Verification code has already sent."
			));
		}

		$seed = str_split('ABCDEFGHIJKLMNPQRSTUVWXYZ123456789');
		$code = "";
		foreach (array_rand($seed, 8) as $k)
		{
			$code .= $seed[$k];
		}

		require ('PHPMailer/PHPMailerAutoload.php');

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->Username = EMAIL;
		$mail->Password = EMAILPASS;
		$mail->SetFrom(EMAIL, 'A2 PoGo');
		$mail->Subject = "Verification";
		$mail->MsgHTML("Your verification code is $code.");
		$mail->AddAddress($address, "Test");

		if(!$mail->Send()) {
			error_log("Failed to send verification code to $address. " . $mail->ErrorInfo);
			return array("success"=>false, "output"=>array(
				"message"=>"Failed to send message."
			));
		} else {
			db_query("INSERT INTO verification(code, address, user_id) VALUES (?, ?, ?)", array($code, $address, $_SESSION['id']));
			return array("success"=>true);
		}
	}

	public static function saveAccount($form)
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
			$namecheck = db_query("SELECT name FROM account WHERE name = ? AND user_id = ?", array($name, $_SESSION['id']));
		}
		else
		{
			$namecheck = db_query("SELECT name FROM account WHERE name = ? AND user_id = ? AND id != ?", array($name, $_SESSION['id'], $form['id']));
		}

		if (count($namecheck))
		{
			return array('success'=>false, 'output'=>array(
				"message"=>"This name is already in use."
			));
		}

		if ($form['type'] === 'phone' || $form['type'] === 'email')
		{
			if ($form['new'])
			{
				if ($form['type'] === 'Phone')
				{
					$address = trim($form['number'] . '@' . $form['carrier']);
				}
				else {
					$address = trim($form['address']);
				}

				$codecheck = db_query("SELECT address FROM verification WHERE address = ? AND code = ?", array($address, $form['verification']));
				if (!count($codecheck))
				{
					return array('success'=>false, 'output'=>array(
						"message"=>"Invalid verification code."
					));
				}

				db_query("INSERT INTO account(user_id, name, address, type) VALUES (?, ?, ?, ?)", array($_SESSION['id'], $name, $address, strtolower($form['type'])));
				db_query("DELETE FROM verification WHERE address = ? AND user_id = ?", array($address, $_SESSION['id']));
			}
			else
			{
				db_query("UPDATE account SET name = ? WHERE id = ? AND user_id = ?", array($name, $form['id'], $_SESSION['id']));
			}

		}
		elseif ($form['type'] === "slack" || $form['type'] === "discord")
		{
			$hook_format = array(
				"slack"=>"https://hooks.slack.com/services",
				"discord"=>"https://discordapp.com/api/webhooks"
			);

			// check if valid webhook format
			if (substr($form['webhook'], 0, strlen($hook_format[$form['type']])) !== $hook_format[$form['type']])
			{
				return array('success'=>false, 'output'=>array(
					"message"=>"Invalid webhook format."
				));
			}

			if (strlen($form['channel']) < 8)
			{
				return array('success'=>false, 'output'=>array(
					"message"=>"Invalid channel ID."
				));
			}

			$extra = json_encode(array('channel'=>$form['channel']));

			if ($form['new'])
			{
				db_query("INSERT INTO account(user_id, name, address, type, extra) VALUES (?, ?, ?, ?, ?)", array($_SESSION['id'], $name, $form['webhook'], strtolower($form['type']), $extra));
			}
			else
			{
				db_query("UPDATE account SET name = ?, address = ?, extra = ? WHERE id = ? AND user_id = ?", array($name, $form['webhook'], $extra, $form['id'], $_SESSION['id']));
			}
		}

		$icon = "fa-question-circle-o";
		switch (strtolower($form['type']))
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

		if ($form['new'])
		{
			$account = db_query("SELECT * FROM account WHERE name = ? AND user_id = ?", array($name, $_SESSION['id']));
		}
		else
		{
			$account = db_query("SELECT * FROM account WHERE id = ? AND user_id = ?", array($form['id'], $_SESSION['id']));
		}

		return array("success"=>true, "output"=>array(
			"fields"=>formatAccount($account[0]),
			"new"=>($form['new'] ? true : false)
		));
	}
}

?>
