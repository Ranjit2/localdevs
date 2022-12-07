<template>
    <div class="row">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Talents</div>
                <div class="card-body">
                    <div class="mt-2 col-md-12" v-for="(user, index) in users" :key="index">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-4">
                                <div class="d-flex text-black">
                                    <div class="flex-shrink-0">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                            alt="Generic placeholder image" class="img-fluid"
                                            style="width: 180px; border-radius: 10px;">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-1"> {{ user.name }}</h5>
                                        <p class="mb-2 pb-1" style="color: #2b2a2a;">Senior Software Enginner @Microsoft
                                        </p>
                                        <span class="font-medium text-success fs-5 mt-2">
                                            15+ experience education sector, tech-business-product background,
                                            early-to-late
                                            stage
                                            experience, hands-on
                                        </span>
                                        <hr>
                                        <p>Hello. 👋🏽 I'm Luna. I’m a problem solver who has 10+ years experience with
                                            research
                                            to
                                            drive strategy. My expertise is mostly research but for the past years
                                            digital
                                            products
                                            discovery and validation have been my life. I can easily map pain points and
                                            synthesize
                                            useful insights. I am a...</p>
                                        <div class="skills p-2">
                                            <span v-for="(skill, index) in user.skills" :key="index"
                                                class="badge text-bg-primary p-2" style="margin-left: 3px;;"> {{ skill.
        name
                                                }}</span>
                                        </div>
                                        <div class="d-flex justify-content-start rounded-3 p-2 mb-2 mt-2"
                                            style="background-color: #efefef;">
                                            <div>
                                                <p class="small text-muted mb-1">Articles</p>
                                                <p class="mb-0">41</p>
                                            </div>
                                            <div class="px-3">
                                                <p class="small text-muted mb-1">Followers</p>
                                                <p class="mb-0">976</p>
                                            </div>
                                            <div>
                                                <p class="small text-muted mb-1">Rating</p>
                                                <p class="mb-0">8.5</p>
                                            </div>
                                        </div>
                                        <div class="d-flex pt-1">
                                            <router-link :to =" '/profile/' + user.id " class="btn btn-secondary flex-grow-1">View profile</router-link>&nbsp;
                                            <button type="button" class="btn btn-primary flex-grow-1">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Filter
                </div>
                <div class="card-body">
                    <Filter />
                </div>
            </div>
        </div>
        
    </div>
</template>

<script setup>
import Filter from "./Filter.vue";
import axios from "axios";
import { ref, onMounted, watch } from "vue";
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()

const topics = ref([]);
const users = ref([]);
const showDropDown = ref('');
const isLoading = ref(false);

const getTopics = (query) => {
    axios
        .post("filter/talents", { filters: query })
        .then((response) => {
            users.value = response.data;
            isLoading.value = false
        });
}
watch(
    () => {

        if (route.query.preference == "wfh") {
            const { place, ...to } = route.query;
            // $router.replace({ query: to });
        }
        getTopics(route.query)
    })

const dropdownFunction = (userId) => {
    showDropDown.value = userId;

}
const closeBox = () => {
    showDropDown.value = false;
}
onMounted(() => {
    getTopics(route.query);
    console.log('query:', route.query)

})



// export default {
//     data() {
//         return {
//             topics: [],
//             users: [],
//             showDropDown: '',
//             isLoading: false
//         };
//     },
//     components: {
//         Filter,
//     },
//     watch: {
//         $route(to, from) {
//             if (this.$route.query.preference == "wfh") {
//                 const { place, ...to } = this.$route.query;
//                 this.$router.replace({ query: to });
//                 //this.$router.replace({query: {'my_query': 1}});
//             }
//             console.log('url',this.$route.query);
//             this.getTopics(this.$route.query);
//         },
//     },
//     methods: {
//         getTopics(query) {
//             console.log('final',query);
//             this.isLoading = true
//             axios
//                 .post("filter/talents", { filters: query })
//                 .then((response) => {
//                     this.users = response.data;
//                     this.isLoading = false
//                 });
//             //send query to endpoint
//             // this.topics.push(query);
//         },
//         dropdownFunction(userId) {
//             this.showDropDown = userId;

//         },
//         closeBox() {
//             this.showDropDown = false;
//         }

//     },
//     mounted() {
//         console.log('q',this.$route.query)
//         this.getTopics(this.$route.query);
//     },
// };

</script>
