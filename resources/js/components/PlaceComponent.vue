<template>
  <nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
      <router-link class="navbar-brand text-white" to="/app">
        Back
      </router-link>
    </div>
  </nav>
  <main class="py-4">
    <div class="d-flex vh-100 justify-content-center align-items-center flex-column loader-div" v-if="weather == null">
      <img src="../../images/loader/loader.svg" height="200" width="200"/>
      <h4 class="text-white">Getting weather for {{ place }} please wait...</h4>
    </div>
    <div class="container" v-if="weather != null">
      <h1 class="mb-5 text-white">{{ place }} | <small>{{ getReadableDay(weather.forecast[0].dt_txt) }}, {{ getReadableDate(weather.forecast[0].dt_txt) }} of {{ getReadableMonth(weather.forecast[0].dt_txt) }}</small></h1>
      <div class="row justify-content-around">
        <div v-for="forecast in weather.forecast" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-4">
          <div class="card shadow">
            <div class="card-header text-muted text-center bg-card-header">
             <p class="fs-5 m-0">{{ getReadableTime(forecast.dt_txt) }}</p> 
            </div>
            <div class="card-body bg-card-body">
              <div style="height: 150px;" class="d-flex justify-content-around align-items-center flex-row border-radius-5">
                <div class="col-6 h-100 d-flex justify-content-around align-items-center flex-column">
                  <h1 :class="renderColor(forecast.main.temp)">{{ formatTemperature(forecast.main.temp) }}</h1>
                  <small :class="renderColor(forecast.main.feels_like)">Feels like: {{ formatTemperature(forecast.main.feels_like) }}</small>
                  <small class="min-txt" :class="renderColor(forecast.main.temp_min)">Min: {{ formatTemperature(forecast.main.temp_min) }}</small><small class="max-txt" :class="renderColor(forecast.main.temp_max)">Max: {{ formatTemperature(forecast.main.temp_max) }}</small>
                </div>
                <div class="col-6 h-100 d-flex justify-content-around align-items-center flex-column">
                  <h4 class="m-0">
                    Rain potential: {{ formatPrecipitation(forecast.pop) }}
                  </h4>
                  <p class="m-0">
                    Wind speed: {{ formatWindSpeed(forecast.wind.speed) }}
                  </p>
                  <p class="m-0">
                    Humidity: {{ formatHumidity(forecast.main.humidity) }}
                  </p>
                </div>
              </div>
            </div>
            <div class="card-footer text-muted text-center bg-card-footer">
             <p class="fs-5 m-0 text-capitalize">{{ forecast.weather[0].description }}</p> 
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- <a href="https://www.flaticon.com/free-icons/humidity" title="humidity icons">Humidity icons created by justicon - Flaticon</a> -->
      </div>
    </div>
  </main>
  
</template>

<script>
  import { getWeather } from './../service/weather/api';
  import moment from 'moment';

  export default {
    props: ['place'],
    mounted() {
        this.getForecast(this.place);
    },
    data () {
      return {
        weather: null,
        details: null
      }
    },
    methods: { 
      getReadableDate(ts) {
        return moment(ts).format('Do');
      },
      getReadableMonth(ts) {
        return moment(ts).format('MMMM');
      },
      getReadableDay(ts) {
        return moment(ts).format('dddd')
      },
      getReadableTime(ts) {
        return moment(ts).format('hh:mm a')
      },
      formatPrecipitation(n) {
        return Math.round(n*100) + '%';
      },
      formatTemperature(n) {
        return n+'°C';
      },
      formatHumidity(n) {
        return n+'%';
      },
      formatWindSpeed(n) {
        return n+'m/s';
      },
      getForecast(place) {
        let x = this;
        getWeather(place).then(function(response) {
          if(response.isSuccess) {
            x.weather = response
          }
        });
      },
      renderColor(temp) {
        if( temp < 25 ) {
          return 'cold';
        } else if(temp >= 25 && temp <= 29.99 ) {
          return 'cool';
        } else if(temp >= 30 && temp <= 34.99 ) {
          return 'warm';
        } else if(temp >= 35 ) {
          return 'hot';
        }
      }
    }
  }
</script>
