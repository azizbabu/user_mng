 <?php
 session_start();

$email =$_SESSION['email'];

function sendMail($email,$password){

$to = $email /* separated by comma for another email (useful if you want to keep records(sending to yourself))*/;
$subject = 'INSERT_SUBJECT_HERE';

$bound_text = "----*%$!$%*";
$bound = "--".$bound_text."\r\n";
$bound_last = "--".$bound_text."--\r\n";

$headers = "From: azizbabu10@yahoo.com\r\n";
$headers .= "MIME-Version: 1.0\r\n" .
        "Content-Type: multipart/mixed; boundary=\"$bound_text\""."\r\n" ;

$message = " you may wish to enable your email program to accept HTML \r\n".
        $bound;

$message .=
'Content-Type: text/html; charset=UTF-8'."\r\n".
'Content-Transfer-Encoding: 7bit'."\r\n\r\n".
'<body font size="3" color="#000000" style="text-decoration:none;font-family:Lato light">
	<div class="info" Style="align:left;">
		<p>Your new login password is: ' .$password.'</p>
	</div>
	</br>
	<p>-----------------------------------------------------------------------------------------------------------------</p>
	</br>
	<p>( This is an automated message, please do not reply to this message, if you have any queries please contact azizbabu10@yahoo.com )</p>
	</body>
	'."\n\n". $bound_last;

	 return mail($to, $subject, $message, $headers); // finally sending the email

}


function createRandomPassword() {
    	$chars = "ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
    	$i = 0;
    	$pass = '' ;

    	while ($i <= 8) {
    		$num = mt_rand(0,61);
    		$tmp = substr($chars, $num, 1);
    		$pass = $pass . $tmp;
    		$i++;
    	}
    	return $pass;
    }

    $pw = createRandomPassword();
    $mail = sendMail($email,$pw);
    // echo "<br/>$pw<br/>";
    $password = md5($pw);
    // echo $password;

    include 'db.php';

    $sql = "UPDATE members SET password = '$password' WHERE email = '$email'";
    $result = mysql_query($sql);
    if($result && $mail){
    	echo "A new password is sent to your email, please login with this password.";
    }else{
    	echo "Some problem in your email configaration";
    }
