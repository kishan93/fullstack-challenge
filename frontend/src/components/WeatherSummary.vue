<script setup lang="ts">
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const props = defineProps({
  weatherData: Object,
})
</script>

<template>
  <div class="">
    <p v-if="!weatherData">Weather data not available</p>
    <template v-else>
      <span class="rounded-pill bg-dark text-white px-2 py-1 mx-1">
        <font-awesome-icon icon="fa-solid fa-thermometer-quarter" />
        {{weatherData.info.temperature}}{{weatherData.info.temperatureUnit}}
      </span>

      <span class="rounded-pill bg-dark text-white px-2 py-1 mx-1">
        <font-awesome-icon icon="fa-brands fa-skyatlas" />
        {{weatherData.info.windSpeed}} {{weatherData.info.windDirection}}
      </span>

    </template>
  </div>
</template>
