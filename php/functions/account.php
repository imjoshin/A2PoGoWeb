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
}

?>
