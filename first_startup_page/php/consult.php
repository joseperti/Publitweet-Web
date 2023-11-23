<?php
        session_start();
        require_once("twitteroauth.php"); //Obtenemos la librería de acceso
         
        $twitteruser = $_GET["nombre"];
        $notweets = 1;
        $consumerkey = "rey0KUhxnaMWWneBtL8UA";
        $consumersecret = "Mh5XHMgzOPM0totOflvrMMnQLJYw8OG5trXImsPHRM";
        $accesstoken = "253145620-W7P74YI0ATn81s9w9SSBz7VD3GEcT3OLgW7toPvo";
        $accesstokensecret = "qryUeBgU43YJ2etFqEA1QcpReZgg5CvwXr9aiRsrprEEv";
         
        function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
          $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
          return $connection;
        }
         
        $connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
        $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
	echo json_encode($tweets[0]);
        
?>