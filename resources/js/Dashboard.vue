<template>
    <div id="dashboard mt-5">
        <div class="row">
            <div class="col-md-3">
                <h3>Dashboard</h3>
                <div class="list-group">
                    <router-link class="list-group-item list-group-item-action " to="/dashboard">Dashboard</router-link>
                    <router-link class="list-group-item list-group-item-action"
                        :to="'/user/profile/' + slug + '/edit'">Profile</router-link>
                    <router-link class="list-group-item list-group-item-action" to="/user/expertise">Top
                        Expertise</router-link>
                    <router-link class="list-group-item list-group-item-action"
                        :to="'/user/profile/' + slug + '/edit'">Profile</router-link>
                    <router-link class="list-group-item list-group-item-action"
                        :to="'/user/profile/' + slug + '/edit'">Profile</router-link>
                    <router-link class="list-group-item list-group-item-action"
                        :to="'/user/profile/' + slug + '/edit'">Profile</router-link>
                </div>
                <!-- <Header /> -->

            </div>
            <div class="col-md-9 ">

                <UserDashboardLoading v-if="isLoading" />
                <div class="card mt-5" v-if="!isLoading">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img v-if="userData.profileImage" :src="userData.profileImage" alt="User Profile Image"
                                    class="img-fluid rounded-circle">
                                <img v-else src="https://via.placeholder.com/150" alt="User Profile Image"
                                    class="img-fluid rounded-circle">
                            </div>
                            <div class="col-md-10">
                                <h2 class="fw-bold">{{ userData.firstname }}&nbsp;{{ userData.lastname }}</h2>
                                <i class='fas fa-map-marker-alt' style='font-size:larger ;color:grey'></i>&nbsp;{{
                                    userData.address }}
                                <p>{{ userData.about }}</p>
                                <div class="mt-3">
                                    <span class="fw-bold">Expertise:</span>
                                    {{ userData.expertise }}
                                </div>
                                <div class="mt-3">
                                    <span class="fw-bold">Skills: </span>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Skills"
                                    v-for="(skill, index) in userData.skillNames" :key="index">
                                    <button type="button" class="btn rounded-pill" style="background-color: rgb(241, 245, 249); 
                                    color: #000; margin-right: 2px;margin-top: 2px;">{{ skill }}</button>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <span class="fw-bold">Days available: </span>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="monday" id="monday"
                                            value="Monday" title="Monday" :checked="availableDays.includes('Monday')">
                                        <label class="form-check-label" for="monday">M</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tuesday" id="tuesday"
                                            value="Tuesday" title="Tuesday" :checked="availableDays.includes('Tuesday')">
                                        <label class="form-check-label" for="tuesday">T</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="wednesday" id="wednesday"
                                            value="Wednesday" title="Wednesday"
                                            :checked="availableDays.includes('Wednesday')">
                                        <label class="form-check-label" for="wednesday">W</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="thursday" id="thursday"
                                            value="Thursday" title="Thursday" :checked="availableDays.includes('Thursday')">
                                        <label class="form-check-label" for="thursday">Th</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="friday" id="friday"
                                            value="Friday" title="Friday" :checked="availableDays.includes('Friday')">
                                        <label class="form-check-label" for="friday">F</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="saturday" id="saturday"
                                            value="Saturday" title="Saturday" :checked="availableDays.includes('Saturday')">
                                        <label class="form-check-label" for="saturday">Sa</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sunday" id="sunday"
                                            value="Sunday" title="Sunday" :disabled="availableDays.includes('Sunday')"
                                            :checked="availableDays.includes('Sunday')">
                                        <label class="form-check-label" for="sunday">Su</label>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <span class="fw-bold">Work Type: </span>
                                    <button v-for="(work, index) in userData.workType" :key="index" type="button"
                                        class="btn" style="background-color: rgb(241, 245, 249); color: #000;">{{ work
                                        }}</button>
                                </div>
                                <div class="mt-3">
                                    <span class="fw-bold">Work preference: </span>
                                    <button v-for="(work, index) in userData.workPreference" :key="index" type="button"
                                        class="btn" style="background-color: rgb(241, 245, 249); color: #000;">{{
                                            work == 'wfh' ? 'Work from home' : work }}</button>
                                </div>
                                <div class="mt-3">
                                    <span class="fw-bold">Experience:&nbsp;</span>
                                    <b>{{ userData.experience }}</b> &nbsp;years
                                </div>
                                <div class="mt-3">
                                    <span class="fw-bold">Role level:&nbsp;</span>
                                    {{ userData.roleLevel }} &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="userData.skillNames?.length>0" class="card mt-5" :class="{'animate__animated animate__flipInX': next}">
                    <div class="card-body text-center">
                        <div class="row align-items-center" v-for="(skill, index) in userData.skillNames" :key="index">
                            <div class="col-auto">
                                <p class="lead mt-2" v-if="currentPage == index">How many years of experience do you have with
                                    <b style="color: #5624d0;font-size:larger">{{ skill }}</b>? 
                                    {{ yearOfExperience.length > 0 ? (yearOfExperience[index]==-1?'less then':yearOfExperience[index]) 
                                    :(userData.skillYears[index]==-1?'less then':userData.skillYears[index]) }}&nbsp; years
                                </p>
                            </div>

                            <div class="col-auto" v-if="currentPage == index">
                                <select v-model="year" class="form-select" @change="updateYear(userData.skills[index])">
                                    <option value="">Select your experience</option>
                                    <option value="-1">Less than 1 year</option>
                                    <option value="1">1 year</option>
                                    <option value="2">2 years</option>
                                    <option value="3">3 years</option>
                                    <option value="4">4 years</option>
                                    <option value="5">5 years</option>
                                    <option value="6">6 years</option>
                                    <option value="7">7 years</option>
                                    <option value="8">8 years</option>
                                    <option value="9">9 years</option>
                                    <option value="10+">More than 10 years</option>
                                </select>
                            </div>

                        </div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <button @click="previousPage"  style="background-color: #5624d0;color: #fff;" v-if="currentPage > 0">Previous Question</button>
                            </div>

                            <div class="col-auto">
                                <button @click="nextPage" style="background-color: #5624d0;color: #fff;"
                                    :disabled="currentPage === userData.skillNames?.length - 1">Next Question</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- <div class="card mt-5" v-if="!isLoading">
                    <div class="card-body text-center">
                        <p class="lead">Your profile is live and you are availble for a work</p>
                        <p>If you are not availble for a certain time then please select the data and save it</p>
                    </div>
                </div> -->
                <!-- <div class="card mt-2" v-if="!isLoading">
                    <div class="card-body text-center" style="min-height: 300px;">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-3">
                                <Datepicker v-model="picked" class="form-control" />
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script setup>
import Header from './Header.vue'
import { useUserStore } from '@/stores/user'
import { ref, onMounted } from 'vue'
import axios from 'axios';
import Datepicker from 'vue3-datepicker'
import 'animate.css';
import UserDashboardLoading from './components/UserDashboardLoading.vue';
const picked = ref(new Date())
const isLoading = ref(false)
const userData = ref([]);
//initially userData.availableDays is empty, onMounted takes some time to push data to userData.availableDays, 
//so our includes method will not work. Therfore, we will set seven days in availableDays array before page mount
//and later we will update this array with response availableDays, this is solve undefined "includes" error or fo setTimeOut 
const availableDays = ref(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
const slug = ref('')
const year = ref('')
const yearOfExperience = ref([])
const currentPage = ref(0);
const next = ref(false)

onMounted(() => {
    isLoading.value = true
    axios.get('/user/details').then((response) => {
        userData.value = response.data
        availableDays.value = response.data.availableDays
        slug.value = response.data.slug
        isLoading.value = false
    });
})

const updateYear = ((skillId) => {
    axios.post('/user/update-experience', { skillId: skillId, year: year.value }).then((response) => {
        yearOfExperience.value = response.data.yearOfExperiences
        console.log(response.data.yearOfExperiences)
    }).catch((error) => {

    })
})

const nextPage = () => {
    currentPage.value++
    next.value = true
    setTimeout(() => {
        next.value = false
    }, 500);
}
const previousPage = () => {
    if (currentPage.value > 0) {
        currentPage.value--;
    }
};
</script>

<style >
/* Change checked checkbox color to #4a4a4a */
.form-check-input:checked {
    background-color: #5624d0;
    border-color: #5624d0;
}
.btn-light{
    background-color: #5624d0;
    border-color: #5624d0;
    color: #fff;
}
.btn-light:hover{
    background-color: #4d0cef;
    border-color: #4d0cef;
    color: #fff;
}
</style>