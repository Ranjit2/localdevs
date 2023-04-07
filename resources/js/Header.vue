<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <router-link to="/dashboard" class="navbar-brand" :class="$route.name == 'Dashboard'? 'active':''"  style="color:#8585FF">
                <i class="bi bi-house-fill"></i>Dashboard
            </router-link>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <router-link :to="'/user/profile/' + slug + '/edit'" class="nav-link" aria-current="page"
                            href="#" style="font-weight: bold;" :class="$route.name == 'ProfileEdit'? 'activee':''" >
                            <i class="bi bi-person-fill"></i>Profile
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/user/expertise" class="nav-link" href="#">Expertise</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-money"></i> Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<style scoped>
.activee{
    color:#1d1dff!important;;
}
.nav-link {
    color: #8585FF;
    font-size: 18px;
    text-decoration: none;
    position: relative;
    padding: 10px 0;
}

.nav-link:hover {
    color: #1d1dff;
}
.active {
  font-weight: bold;
}

</style>

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