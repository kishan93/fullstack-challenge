<script setup lang="ts">
import {computed, onMounted, ref} from "vue";
import {fetchUsersData, getUser} from "@/api/users";
import UserRow from "@/components/UserRow.vue";
import CustomModal from "@/components/CustomModal.vue";

const users = ref([])
const locationGrids = ref({})
const userModal = ref(null)

const userData = ref({})
const userLocationGrid = ref({})
const loadingData = ref(false)

const weatherData = computed(()=>{
  return userLocationGrid.value.weather_data?.info
})

const fetchData = async () => {
  const data = await fetchUsersData()
  users.value = data.users
  locationGrids.value = data.locationGrids
}

onMounted(() => {
  fetchData()
})

const showUserModal = async (userId) => {
  //fetch data for user:userId
  loadingData.value = true
  userModal.value.show()

  const data = await getUser(userId)
  userData.value = data.user
  userLocationGrid.value = data.locationGrid

  loadingData.value = false
}

</script>

<template>
  <div class="px-5 py-5">
    <table class="table table-bordered table-striped">
      <thead class="bg-dark text-white">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Created Date</th>
          <th scope="col">Weather</th>
        </tr>
      </thead>
      <tbody>
        <template v-for="user in users" :key="user.id">
          <UserRow
            :user="user"
            :location-grid="user.location_grid_id ? locationGrids[user.location_grid_id] : null"
            @showModal="showUserModal"
          />
        </template>
      </tbody>
    </table>

    <CustomModal ref="userModal">
      <template #title>User Weather</template>

      <p v-if="loadingData">
        loading...
      </p>
      <div v-else-if="weatherData">
        <table class="table table-bordered">
          <tbody>

            <tr>
              <th>Forecast</th>
              <td>{{weatherData.shortForecast}}</td>
            </tr>

            <tr>
              <th>Temperature</th>
              <td>{{weatherData.temperature}}{{weatherData.temperatureUnit}}</td>
            </tr>

            <tr>
              <th>Wind</th>
              <td>{{weatherData.windSpeed}} {{weatherData.windDirection}}</td>
            </tr>

            <tr>
              <th>Humidity</th>
              <td>{{weatherData.relativeHumidity.value}}</td>
            </tr>

          </tbody>
        </table>
      </div>
    </CustomModal>
  </div>
</template>
