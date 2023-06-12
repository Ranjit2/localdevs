<template>
  <nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container-fluid">
      <router-link to="/user/dashboard" class="navbar-brand" style="color: #000;font-size:20px;">
        <i class="bi bi-house-fill" style="color: #1d1dffd2;"></i>Dashboard
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
              <i class="bi bi-person-fill" style="color: #1d1dffd2;"></i>Profile
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/user/experience" class="nav-link" href="#"><i style="color: #1d1dffd2;"
                class="bi bi-file-earmark-code-fill"></i>
              Experience</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/user/social" class="nav-link" href="#"><i class="bi bi-share-fill"
                style="color: #1d1dffd2;"></i>
              Social</router-link>
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
  border-radius: 5px;
  height: 60px;
}

.nav-link {

  font-size: 20px;
  font-weight: bold;
  color: #000;
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
  const user = localStorage.getItem('user');
  if (user) {
    slug.value = user
  } else {
    axios.get('/forHeader').then((response) => {
      slug.value = response.data
      localStorage.setItem('user', response.data)
    })
  }

});
</script>