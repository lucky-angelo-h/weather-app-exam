<template>
  <nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
      <div class="navbar-brand text-white">
          Weather app
      </div>
    </div>
  </nav>
  <main class="py-4">
    <div>
      <div class="container h-100">
        <div class="text-white">
          <h1 class="mb-3">Hello traveler!</h1>
          <h4 class="mb-3">Prior to your departure, feel free to look up the weather for the city you plan to visit.</h4>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div v-for="place in places" :key="place.id" class="col-lg-4 col-md-6 col-sm-12 mb-3">
          <router-link :to="'/app/weather/'+place.name" class="text-decoration-none card-list">
            <div class="card shadow" :style="{height: '300px', cursor: 'pointer'}">
              <div class="card-body d-flex justify-content-center align-items-center" :style="{backgroundImage: 'url(' + place.img + ')', backgroundSize: 'cover', backgroundPosition: 'center', backgroundRepeat: 'no-repeat', }">
                <div class="text-white blur-txt">
                  <h1 class="card-title">{{ place.name }}</h1>
                </div>
              </div>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
  import { cities } from './../utils/constants';
  export default {
    mounted() {
        
    },
    data () {
      return {
        places: cities
      }
    },
    methods: {
      
    }
  }
</script>
