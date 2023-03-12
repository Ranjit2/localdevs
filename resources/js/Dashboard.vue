<template>
    <div id="dashboard">
        <div class="row">

        <div class="col-md-4">
            <h1>Dashboard</h1>
            {{ user }}
            <Header />
            {{ userStore.userId }}
            {{ userStore.userRole }}
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias, aliquam? At fugit adipisci omnis vero eius quo commodi deserunt iusto velit debitis, sint maxime odit nobis quia iure nostrum magnam?
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script setup>
import Header from './Header.vue'
import { useUserStore } from '@/stores/user'
import {ref,onMounted} from 'vue'
import axios from 'axios';
const userStore = useUserStore()
const user = ref([]);

onMounted(() => {
    axios.get('/api/profile').then((response) => {
        console.log(response.data)
        user.value = response.data
    })
})
</script>

