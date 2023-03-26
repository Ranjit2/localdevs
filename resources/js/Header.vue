<template>
    <div class="container">
        <!-- <ul class="">list-inline text-center -->
    <!-- <router-link :to="'talent/' + user.slug">Profile</router-link> -->
        <ul>
            <li class=""><router-link to="/dashboard">Dashboard</router-link></li>
            <li class=""><router-link :to="'/user/profile/' + slug+ '/edit'">Profile</router-link></li>
            <li class=""><a href="">Aadd Expertise</a></li>
            <li class=""><a href="">Contact</a></li>
        </ul>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const slug = ref('');

onMounted(() => {
    axios.get('/forHeader').then((response) => {
    slug.value = response.data
})
});
</script>