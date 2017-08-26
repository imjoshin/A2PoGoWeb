<?php

class Account
{
	public static function sendVerificationCode($address)
	{
		if (!filter_var($address, FILTER_VALIDATE_EMAIL))
		{
			return array('success'=>false, 'output'=>"Invalid address.");
		}

		$usercheck = db_query("SELECT address FROM verification WHERE address = ?", array($address));

		if (count($usercheck))
		{
			return array('success'=>false, 'output'=>"Verification code has already sent.");
		}


		$seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
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
			return array("success"=>false, "output"=>"Failed to send message.");
		} else {
			db_query("INSERT INTO verification(code, address) VALUES (?, ?)", array($code, $address));
			return array("success"=>true);
		}
	}

	public static function addAccount($form)
	{
		$name = trim($form['name']);
		$address = trim($form['address']);

		if (!preg_match('/[a-zA-Z0-9 ._-]{1,32}$/', $name))
		{
			return array('success'=>false, 'output'=>'Invalid name.');
		}

		if ($form['type'] === 'Phone/Email')
		{
			$usercheck = db_query("SELECT address FROM verification WHERE address = ? AND code = ?", array($address, $form['verification']));
			if (!count($usercheck))
			{
				return array('success'=>false, 'output'=>"Invalid verification code.");
			}

			$namecheck = db_query("SELECT name FROM account WHERE name = ? AND user_id = ?", array($name, $_SESSION['id']));
			if (count($namecheck))
			{
				return array('success'=>false, 'output'=>"This name is already in use.");
			}

			$namecheck = db_query("SELECT name FROM account WHERE address = ? AND user_id = ?", array($address, $_SESSION['id']));
			if (count($namecheck))
			{
				return array('success'=>false, 'output'=>"This address is already in use.");
			}

			db_query("INSERT INTO account(user_id, name, address) VALUES (?, ?, ?)", array($_SESSION['id'], $name, $address));
			db_query("DELETE FROM verification WHERE address = ?", array($address));

			return array("success"=>true, "output"=>array("name"=>$name, "address"=>$address));
		}
		elseif ($form['type'] === "Slack" || $form['type'] === "Discord")
		{
			error_log('slack/discord');
		}
	}
}

?>
