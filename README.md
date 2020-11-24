# weatherbot


https://heroku.com/deploy?template=https://github.com/Benchamxd/weatherbot/tree/main


``if(strpos($text,"/weather") !== false){ 
$location = trim(str_replace("/weather","",$text)); 

$resp = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=$location&appid=$API_TOKEN"),true);
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
} ``
