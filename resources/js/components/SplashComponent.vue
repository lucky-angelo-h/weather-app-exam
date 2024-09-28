<template>
  <main class="py-4">
    <div class="container d-flex justify-content-center flex-column align-items-center">
      <h1>Welcome to weather app</h1>
      <router-link to="/app">
        Go to Dashborad
      </router-link>
    </div>
      
  </main>
  
</template>

<script>

  export default {
    props: ['place'],
    setup() {
      
    },
    mounted() {
        setTimeout(function() {
            router.push({path: '/app'});
        }, 3000)
    },
    data () {
      
    },
    methods: {
      
    }
  }
</script>