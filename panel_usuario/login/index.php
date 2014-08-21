<?php
	session_start();
	require_once '../php/twitteroauth.php';
	require_once '../php/config_user.php';
	if(!$_SESSION["twitter_status"]){
			$twitter = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET);
			$twitter_temp = $twitter->getRequestToken(OAUTH_CALLBACK);
			$_SESSION["temp_token"]=$twitter_temp["oauth_token"];
			$_SESSION["temp_token_secret"]=$twitter_temp["oauth_token_secret"];
			$twitter_url = $twitter->getAuthorizeURL($twitter_temp["oauth_token"]);
	}else{
		$twitter_url = "../";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accediendo</title>
</head>
<body>
<center>
<script type="text/javascript">
	location.href = <?php echo "'".$twitter_url."';"; ?>
</script>
</body>
</html>