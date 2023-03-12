<template>
<div>
    {{ data }}
    <RouterLink to="/dashboard">Dashboard</RouterLink>
</div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const data = ref([]);
const slug = route.params.slug;

onMounted(() => {
   axios.get('/talent/profile/'+ slug).then((response) => {
        data.value = response.data
        //to get auth id, return auth id form controller in response but this could be security issue
   })

});

</script>
