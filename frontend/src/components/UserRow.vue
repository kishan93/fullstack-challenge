<script setup lang="ts">

import WeatherSummary from "@/components/WeatherSummary.vue";

const props = defineProps({
  user: Object,
  locationGrid: Object,
})

</script>

<template>
  <tr>
    <td>{{ props.user.id }}</td>
    <td>{{ props.user.name }}</td>
    <td>{{ props.user.email }}</td>
    <td>{{ props.user.created_at }}</td>
    <td>
      <WeatherSummary :weather-data="locationGrid?.weather_data"/>
    </td>
  </tr>
</template>
