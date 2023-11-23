<?php
session_start();
require_once 'twitteroauth.php';
require_once 'config.php';

$twitter = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$_SESSION["temp_token"],$_SESSION["temp_token_secret"]);


$twitter_token = $twitter->getAccessToken($_REQUEST["oauth_verifier"]);

if ($twitter->http_code == 200){

  //Verificado
  echo "Verificado";
  $SESSION["twitter_token"]=$twitter_token["oauth_token"];
  $SESSION["twitter_secret"]=$twitter_token["oauth_token_secret"];
  $SESSION["twitter_status"]=true;
  echo $SESSION["twitter_user"];
  //header("Location:login.html");
  
}else{
  //No verificado
  echo "No Verificado";
}
?>