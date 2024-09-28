<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
 


class ApiController extends Controller
{
  private $apiKey = "9fde38a8a66ebe6c61054821e560df45";
  private $ctrycd = "JP";

  public function getWeather(string $place) {
      $place = $this->getPlace($place);
      $forecast = $this->getForecast($place[0]->lat, $place[0]->lon);
      return response()->json($forecast);
  }

  public function getPlace(string $place) {
    $response = Http::get("https://api.openweathermap.org/geo/1.0/direct", [
      'q' => $place.','.$this->ctrycd,
      'limit' => '1',
      'appid' => $this->apiKey,
    ]);

    if($response->ok())
      return $response->object();
  }

  public function getForecast(float $lat, float $lon) {
    $response = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
      'lat' => $lat,
      'lon' => $lon,
      'appid' => $this->apiKey,
      'units' => 'metric',
      'cnt' => 5,
    ]);

    if($response->ok())
      return $response->json();
  }
}
