<?php
use MetzWeb\Instagram\Instagram;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', function () {

  $instagram = new Instagram(array(
      'apiKey'      => '5a58af3c44094a15a6e78095d6a677a9',
      'apiSecret'   => 'c771ee024ad64a9d9b804657e3696d73',
      'apiCallback' => 'http://thetastersuy.app/oauth'
  ));

  echo "<a href='{$instagram->getLoginUrl()}'>Login with Instagram</a>";
    //return view('welcome');
});


Route::get('/oauth', function () {
  $instagram = new Instagram(array(
      'apiKey'      => '5a58af3c44094a15a6e78095d6a677a9',
      'apiSecret'   => 'c771ee024ad64a9d9b804657e3696d73',
      'apiCallback' => 'http://thetastersuy.app/oauth'
  ));

  $code = $_GET['code'];
  $data = $instagram->getOAuthToken($code);

  echo 'Your username is: ' . $data->user->username;

  // set user access token
$instagram->setAccessToken($data);

// get all user likes
$likes = $instagram->getUserLikes();

// take a look at the API response
echo '<pre>';
print_r($likes);
echo '<pre>';

});
