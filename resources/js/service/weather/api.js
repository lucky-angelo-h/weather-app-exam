import axios from 'axios';

const API_KEY = "9fde38a8a66ebe6c61054821e560df45";

let config = {
  headers: {
    "Content-Type": "application/json",
    'Access-Control-Allow-Origin': '*',
  }
}

async function getWeather (place, _callback) {
  try {
    const response = await axios.get("/api/get-weather/"+place)
    if(response.status == 200) {
      return Promise.resolve({'isSuccess': 1, 'forecast': response.data.list, 'details': response.data.city });
    }
  } catch (error) {
    return Promise.resolve({'isSuccess': 0, 'forecast': [], 'details': [] });
  }
  
  
}


export {
  getWeather
}