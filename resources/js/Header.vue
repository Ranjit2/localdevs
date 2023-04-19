<template>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
  
  
      <router-link to="/dashboard" class="navbar-brand" >
              <i class="bi bi-house-fill"></i>Dashboard
          </router-link>
  
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link :to="'/user/profile/' + slug + '/edit'" class="nav-link" aria-current="page" href="#"
                            style="font-weight: bold;" :class="$route.name == 'ProfileEdit' ? 'active' : ''">
                            <i class="bi bi-person-fill"></i>Profile
                        </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/user/expertise" class="nav-link" href="#"><i class="bi bi-file-earmark-code-fill"></i> Expertise</router-link>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-share-fill"></i> Social</a>
          </li>
      
        </ul>
      </div>
    </div>
  </nav>
</template>
<style scoped>
/* .active {
    color: #1d1dff !important;
    ;
} */
.navbar {
    background-color: #ccc;
}
.nav-link {
   
    font-size: 20px;
    font-weight: bold;
    /* color: #1d1dffd2; */
}

.nav-link:hover {
    /* color: #1d1dffd2; */
}

.active {
    /* font-weight: bold; */
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