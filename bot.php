<?php
/*
BY:- @BenchamXD

CHANNEL:- @IndusBots
*/
error_reporting(0);

set_time_limit(0);

flush();
$API_KEY = $HEROKU_ENV['BOT_TOKEN'];
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode
	]);
	}
	
//==============BENCHAM======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $update->message->id;
$chat_id = $message->chat->id;
$name = $from_id = $message->from->first_name;
$from_id = $message->from->id;
$text = $message->text;
$API_KEY = $HEROKU_ENV['API_KEY']
$START_MESSAGE = $HEROKU_ENV['START_MESSAGE'];
$username = $update->message->from->username;
if($text == '/start')
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***$START_MESSAGE***

Use `/weather city` to get the weather info.",
'parse_mode'=>"MarkDown",
]);
if(strpos($text,"/weather") !== false){ 
$location = trim(str_replace("/weather","",$text)); 

$resp = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=$location&appid=$API_KEY"),true);
$weather = $resp['weather'][0]['main'];
$description = $resp['weather'][0]['description'];
$temp = $resp['main']['temp'];
$humidity = $resp['main']['humidity'];
$feels_like = $resp['main']['feels_like'];
$country = $resp['sys']['country'];
$nme = $resp['name'];
$kelvin = 273;
$celcius = $temp - $kelvin;
$feels = $feels_like - $kelvin;
 if($weather['name']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***Weather at $location: $weather
                
Status: $description

Temp : $celcius °C

Feels Like : $feels °C

Humidity: $humidity

Country: $country 

Checked By @$username***",
'parse_mode'=>"MarkDown",

]);
    }
else {
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"INVALID CITY❌",
                
]);
}
} 
