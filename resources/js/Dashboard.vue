<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <Header />
                <h3 class="mt-3">Dashboard</h3>
                <UserDashboardLoading v-if="isLoading" />
                <div class="card mt-2" v-if="!isLoading">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 profile-picture">
                                <img v-if="userData.profileImage" :src="userData.profileImage" alt="User Profile Image"
                                    class="img-fluid rounded-circle">
                                <img v-else src="https://via.placeholder.com/150" alt="User Profile Image"
                                    class="img-fluid rounded-circle">
                            </div>
                            <div class="col-md-10">
                                <h2 class="fw-bold lead">{{ userData.firstname }}&nbsp;{{ userData.lastname }}</h2>
                                
                                 <p class="lead" style="font-weight:bold;">
                                    <i class='bi bi-geo-alt-fill' style='font-size:large ;color:#1d1dff'></i>
                                    <b>{{userData.address }}</b>
                                </p>
                                <p class="lead" style="text-align: justify;">{{ userData.about }}</p>
                                <div class="mt-3 lead">
                                    <span class="fw-bold">Expertise:</span>
                                    {{ userData.expertise }}
                                </div>
                                <div class="mt-3 lead">
                                    <span class="fw-bold" style="">Skills: </span>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Skills"
                                    v-for="(skill, index) in userData.skillNames" :key="index">
                                    <button type="button" class="btn rounded-pill" style="background-color: rgb(241, 245, 249); 
                                    color: #000; margin-right: 2px;margin-top: 2px;font-size: medium">{{ skill }}</button>
                                    </div>
                                </div>

                                <div class="mt-3 lead">
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
                                            value="Sunday" title="Sunday"
                                            :checked="availableDays.includes('Sunday')">
                                        <label class="form-check-label" for="sunday">Su</label>
                                    </div>
                                </div>

                                <div class="mt-3 lead">
                                    <span class="fw-bold">Work Type: </span>
                                    <button v-for="(work, index) in userData.workType" :key="index" type="button"
                                        class="btn rounded-pill" style="background-color: rgb(241, 245, 249); color: #000;font-size: medium;">{{ work
                                        }}</button>
                                </div>
                                <div class="mt-3 lead">
                                    <span class="fw-bold">Work preference: </span>
                                    <div class="btn-group" role="group">
                                        <button v-for="(work, index) in userData.workPreference" :key="index" type="button" class="btn rounded-pill"
                                            style="background-color: rgb(241, 245, 249); color: #000;margin-right: 5px;font-size: medium;">
                                            {{ work == 'wfh' ? 'Work from home' : work }}
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-3 lead">
                                    <span class="fw-bold">Experience:&nbsp;</span>
                                    <b>{{ userData.experience }}</b> &nbsp;years
                                </div>
                                <div class="mt-3 lead">
                                    <span class="fw-bold">Role level:&nbsp;</span>
                                   <span class="lead" style="font-size:large">{{ userData.roleLevel }}</span> &nbsp;
                                </div>
                            </div></div>
                    </div>
                </div>
            

            <div v-if="userData.skillNames?.length>0" class="card mt-5" :class="{'animate__animated animate__flipInX': next}">
                    <div class="card-body" v-if="!isLoading">
                        <div class="card-title fw-bold lead"><i class="bi bi-clock-fill" style="color: #1d1dff"></i> Years of experience</div>
                        <div class="row align-items-center" v-for="(skill, index) in userData.skillNames" :key="index">
                            <div class="col-auto">
                                <p class="lead mt-2" v-if="currentPage == index">How many years of experience do you have with
                                    <b style="color: #5624d0;font-size:medium;font-weight: bold;font-size: 20px;">{{ skill }}</b>? 
                                    Your answer: {{ yearOfExperience.length > 0 ? (yearOfExperience[index]==-1?'less then':yearOfExperience[index]) 
                                    :(userData.skillYears[index]==-1?'less then':userData.skillYears[index]) }}&nbsp; years
                                </p>
                            </div>

                            <div class="col-md-3" v-if="currentPage == index">
                                <select v-model="year" class="form-control" @change="updateYear(userData.skills[index])">
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
                            <p v-if="currentPage == index">
                                <span v-if="userData.skillYears[index]>0">
                                    <a href="#">Add/Update</a>
                                </span>
                            </p>

                        </div>
                        <p v-if="isLoadingExperience"  style="color:#1d1dff ;"> 
                            <i class="fa fa-spinner fa-spin"></i> Updating your experience...  
                        </p>
                
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <button @click="previousPage" style="background-color: #1d1dff;border-color: #1d1dff;color: #fff;" v-if="currentPage > 0"><i class="bi bi-arrow-left-circle"></i>Previous Question</button>
                                &nbsp;
                            </div>

                            <div class="col-auto">
                                <button @click="nextPage" style="background-color: #1d1dff;border-color: #1d1dff;color: #fff;margin-left: -25px;"
                                    :disabled="currentPage === userData.skillNames?.length - 1">Next Question<i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>
            </div>

                <div class="card mt-5" v-if="!isLoading">
                    <div class="card-body lead">
                        <div class="card-title fw-bold"><i class="bi bi-book-fill" style="color: #1d1dff;"></i> Education</div>
                        <div class="col-md-6">
                        <p>What is your higest level of education ?</p>
                        <select v-model="education" class="form-control" @change="updateEducation()">
                            <option value="">Select your experience</option>
                            <option value="">none</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Bachelor">Bachelor Degree</option>
                            <option value="Master">Master Degree</option>
                            <option value="PHD">PHD</option>
                        </select>
                        <br>
                        <p v-if="isLoadingEducation"  style="color:#1d1dff ;"> 
                            <i class="fa fa-spinner fa-spin"></i> Updating your answer...  
                        </p>
                        <span class="mt-2">Your answer: {{  education }}</span>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>
</template>

<script setup>
import Header from './Header.vue'
import { useUserStore } from '@/stores/user'
import { ref, onMounted, computed } from 'vue'
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
const education = ref('');
const isLoadingEducation = ref(false)
const isLoadingExperience = ref(false)
const showAddDescriptionLink = ref(false)

onMounted(() => {
    isLoading.value = true

    axios.get('/user/details').then((response) => {
        userData.value = response.data
        availableDays.value = response.data.availableDays
        slug.value = response.data.slug
        education.value = response.data.education
        isLoading.value = false

    });
})

const updateYear = ((skillId) => {
    isLoadingExperience.value = true
    axios.post('/user/update-experience', { skillId: skillId, year: year.value }).then((response) => {
        yearOfExperience.value = response.data.yearOfExperiences
        isLoadingExperience.value = false
        showAddDescriptionLink.value = true
    }).catch((error) => {
        alert('error while updating experience. please refresh the page and try again')
    })
})

const updateEducation = () => {
    isLoadingEducation.value = true
    axios.post('/user/update-education', { education: education.value }).then((response) => {
      //  education.value = response.data.education
      isLoadingEducation.value = false
    }).catch((error) => {
        alert('error while updating')
    })
}

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

<style scoped>
body {
  font-size: 16px; /* Set a comfortable font size */
  line-height: 1.5; /* Set a comfortable line-height */
  margin-bottom: 1rem; /* Add some space between paragraphs */
}
.card {
    border: 1px solid rgb(233, 220, 220);
}
.medium-font {
  font-size: 16px; /* or any other medium font size you prefer */
}
/* input[type="radio"] {

    width: 20px;
    height: 20px;
    margin-right: 5px;
    border-radius: 4px;
    outline: none;
    cursor: pointer;
} */
/* Change checked checkbox color to #4a4a4a */

.form-check-input:checked {
    background-color: #1d1dff;
    border-color: #1d1dff;
}
.btn-light{
    background-color: #1d1dff;
    border-color: #1d1dff;
    color: #fff;
}
.btn-light:hover{
    background-color: #04045bed;
    border-color: #04045bed;
    color: #fff;
}

.profile-picture {
    display: flex;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.profile-picture img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 3px solid #4a4a4a;
}

</style>