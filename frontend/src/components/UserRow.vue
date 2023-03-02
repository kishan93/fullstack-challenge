<script setup lang="ts">

import WeatherSummary from "@/components/WeatherSummary.vue";
import {computed} from "vue";

const props = defineProps({
  user: Object,
  locationGrid: Object,
})

const emit = defineEmits(['showModal'])

const hasData = computed(() => {
  return props.locationGrid?.weather_data
})

</script>

<template>
  <tr
    @click="hasData ? emit('showModal', props.user.id): ''"
    :class="[
      hasData ? 'cursor-pointer' : ''
    ]"
  >
    <td>{{ user.id }}</td>
    <td>{{ user.name }}</td>
    <td>{{ user.email }}</td>
    <td>{{ user.created_at }}</td>
    <td>
      <WeatherSummary :weather-data="hasData"/>
    </td>
  </tr>
</template>


<style scoped>
.cursor-pointer{
  cursor: pointer;
}
</style>
