<script setup lang="ts">

import {onMounted, ref} from "vue";

const users = ref([])
const fetchData = async () => {
  const url = import.meta.env.VITE_BASE_URL
  const data = await (await fetch(url)).json()
  users.value = data.users
}
onMounted(()=>{
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
        </tr>
      </thead>
      <tbody>
        <template v-for="(user, index) in users">
          <tr>
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.created_at }}</td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>
