<script setup lang="ts">
import {onMounted, ref} from "vue";
import {fetchUsersData} from "@/api/users";
import UserRow from "@/components/UserRow.vue";

const users = ref([])
const locationGrids = ref({})

const fetchData = async () => {
  const data = await fetchUsersData()
  users.value = data.users
  locationGrids.value = data.locationGrids
}

onMounted(() => {
  fetchData()
})

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
          />
        </template>
      </tbody>
    </table>
  </div>
</template>
