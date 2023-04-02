<template>
    <ProfileEditLoading v-if="isLoading" />
    <!-- <RouterLink to="/dashboard" v-if="!isLoading" class="btn btn-light" style="background-color:#5624d0;color:#fff;">Back to
                    Dashboard</RouterLink> -->
    <div class="row justify-content-center" v-if="!isLoading">
        <div class="col-md-10">
            <Header />
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="text-center" style="color:#000082">Make your profile outstanding</h4>
                    </div>
                    <div class="d-flex flex-column align-items-center text-center">
                        <p id="errorUploadingImage"></p>

                        <p v-if="status">Uploading...<br>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" :style="{ width: `${progress}%` }"
                                :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                                {{ progress }}%
                            </div>
                        </div>
                        </p>

                        <div class="image-container profile-picture">
                            <img v-if="profileImage" class="rounded-circle" :src="profileImage"
                                style="border:1px solid #ccc;border-radius: 50%;">
                            <img v-else src="https://via.placeholder.com/150" alt="User Profile Image"
                                class="img-fluid rounded-circle">
                            <label for="image-upload" class="image-upload-label">
                                <i class="fa fa-camera"></i>
                                Upload Image
                            </label>
                            <input type="file" ref="myImage" id="image-upload" class="image-upload-input"
                                @change="updateProfilePicture()">
                        </div>

                        <span class="font-weight-bold">{{ formData.firstname }}&nbsp;{{ formData.lastname }}</span>
                        <span class="text-black-50">{{ expertise }}</span>
                        <span>{{ address }}</span>
                    </div>
                    <form @submit.prevent="formOnSubmit" method="POST">
                        <div class="p-3 py-1">

                            <div class="row mt-2">
                                <!-- {{ formData }} -->
                                <hr>
                                <!-- {{ formData.userBasedSkillList }} -->
                                <div class="col-md-6 fw-bold" id="firstname">First name

                                    <input type="text" class="form-control" id="fname" placeholder="first name"
                                        v-model="formData.firstname" disabled>
                                </div>
                                <span v-for="error in v$.firstname.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>

                                <div class="col-md-6 fw-bold">Last name
                                    <input type="text" v-model="formData.lastname" id="lname" class="form-control"
                                        placeholder="Doe" disabled>
                                </div>

                                <span v-for="error in v$.lastname.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                                <a href="#" @click.prevent="enableEditing">enable editing</a>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 fw-bold">About me
                                    <textarea class="form-control" v-model="formData.about" cols="" rows=""></textarea>
                                </div>
                                <span v-for="error in v$.about.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mt-3 fw-bold">Year of experience
                                    <select class="form-control" v-model="formData.experience">
                                        <option name="" value="1">1 year</option>
                                        <option name="" value="2">2 years</option>
                                        <option name="" value="3">3 years</option>
                                        <option name="" value="4">4 years</option>
                                        <option name="" value="5">5 years</option>
                                        <option name="" value="6">6 years</option>
                                        <option name="" value="7">7 years</option>
                                        <option name="" value="8">8 years</option>
                                        <option name="" value="9">9 years</option>
                                        <option name="" value="10">10 years</option>
                                        <option name="" value="11">11 years</option>
                                        <option name="" value="12">12 years</option>
                                        <option name="" value="13">13 years</option>
                                        <option name="" value="14">14 years</option>
                                        <option name="" value="15">15 years</option>
                                    </select>
                                </div>
                                <span v-for="error in v$.about.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                                <div class="col-md-6 mt-3 fw-bold">Role level
                                    <select class="form-control" v-model="formData.roleLevel">
                                        <option name="" value="Junior">Junior level</option>
                                        <option name="" value="Mid-level">Mid-level</option>
                                        <option name="" value="Senior">Senior level</option>
                                        <option name="" value="c-level">c-level</option>
                                    </select>
                                </div>
                                <span v-for="error in v$.about.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <div class="col-md-12 mt-3 fw-bold">
                                <label for="district">Where do you live?</label>
                                <input type="text" class="form-control" v-model="formData.search" @input="filterDistricts"
                                    @click="showOptionPlaces = true">
                                <div class="card mt-1 shadow-sm" v-show="showOptionPlaces">
                                    <div class="card-body" style="max-height:200px;overflow-y:scroll">
                                        <ul class="list-group">
                                            <li v-for="district in filteredDistricts" :key="district.id"
                                                class="list-group-item">
                                                <label class="form-check-label" :for="district.id"
                                                    @click="selectDistrict(district)">
                                                    {{ district }}
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <span class="error-red">

                                </span>

                            </div>

                            <div class="row">
                                <div class="col-md-4 mt-3 fw-bold">Your website
                                    <input type="text" class="form-control">
                                </div>
                                <span v-for="error in v$.about.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                                <div class="col-md-4 mt-3 fw-bold">LinkedIn
                                    <input type="text" class="form-control">
                                </div>
                                <span v-for="error in v$.about.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                                <div class="col-md-4 mt-3 fw-bold">Github
                                    <input id="input-github" name="github" v-model="formData.github"
                                        @keyup="formData.github" type="text" placeholder="https://github.com/"
                                        class="form-control">

                                    <p style="color:red" v-if="githubFiledErrorMessage && formData.github.length > 3">{{
                                        githubFiledErrorMessage }}</p>
                                    <span v-for="error in v$.github.$errors" :key="error.$uid" class="error-red">
                                        {{ error.$message }}
                                    </span>
                                </div>
                                <span v-for="error in v$.about.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <hr>

                            <div class="mb-3 mt-2">
                                <label for="days" class="form-label"><b>Days Available</b></label><br>
                                <div class="form-check form-check-inline" v-for="(day, index) in days">
                                    <input class="form-check-input" type="checkbox" v-model="formData.availableDays"
                                        :value="day.name" :id="index" :checked="formData.availableDays.includes(day.name)">
                                    <label class="form-check-label" :for="index">{{ day.name }}</label>
                                    <span v-for="error in v$.availableDays.$errors" :key="error.$uid" class="error-red">
                                        {{ error.$message }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <!-- {{ formData.workType }} -->
                                <label for="days" class="form-label"><b>Work Types</b></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="freelancer" type="checkbox"
                                        checked="formData.workType.includes('freelancer')" value="freelancer"
                                        v-model="formData.workType">
                                    <label class="form-check-label" for="freelancer">Long term </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="employee" type="checkbox"
                                        checked="formData.workType.includes('freelancer')" value="employee"
                                        v-model="formData.workType">
                                    <label class="form-check-label" for="employee">Short term</label>
                                </div>
                                <span v-for="error in v$.workType.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>
                            <h5>Skills</h5>

                            <div class="mb-3" v-if="userBasedSkillList.programming">
                                <label for="days" class="form-label" v-if="userBasedSkillList.programming"><b>Programming
                                        Languages</b></label><br>
                                <div class="form-check form-check-inline"
                                    v-for="(programming, index) in userBasedSkillList.programming">

                                    <input type="checkbox" class="form-check-input" v-model="formData.userSelectedSkills"
                                        :checked="formData.userSelectedSkills.includes(index)" :value="index"
                                        :id="programming" />
                                    <!-- index is ID here, not index that starts from 0 -->
                                    <label class="form-check-label" :for="programming"> {{ programming }}</label>
                                    <span v-for="error in v$.availableDays.$errors" :key="error.$uid" class="error-red">
                                        {{ error.$message }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3" v-if="userBasedSkillList.framework">
                                <label for="days" class="form-label" v-if="userBasedSkillList.framework"><b>Web Frameworks,
                                        CMS
                                        &
                                        Mobile Development</b>
                                </label><br>
                                <div class="form-check form-check-inline"
                                    v-for="(framework, index) in userBasedSkillList.framework">
                                    <input type="checkbox" class="form-check-input" v-model="formData.userSelectedSkills"
                                        :checked="formData.userSelectedSkills.includes(framework)" :value="index"
                                        :id="framework" />
                                    <label class="form-check-label" :for="framework">{{ framework }}</label>
                                    <span v-for="error in v$.availableDays.$errors" :key="error.$uid" class="error-red">
                                        {{ error.$message }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3" v-if="userBasedSkillList.database">
                                <label for="days" class="form-label"><b>Databases</b>
                                </label><br>
                                <div class="form-check form-check-inline"
                                    v-for="(database, index) in userBasedSkillList.database">
                                    <input type="checkbox" class="form-check-input" v-model="formData.userSelectedSkills"
                                        :checked="formData.userSelectedSkills.includes(database)" :value="index"
                                        :id="database" />
                                    <label class="form-check-label" :for="database">{{ database }}</label>
                                    <span v-for="error in v$.availableDays.$errors" :key="error.$uid" class="error-red">
                                        {{ error.$message }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3" v-if="userBasedSkillList.motion">
                                <label for="days" class="form-label"><b>Motion</b>
                                </label><br>
                                <div class="form-check form-check-inline"
                                    v-for="(motion, index) in userBasedSkillList.motion">
                                    <input type="checkbox" class="form-check-input" v-model="formData.userSelectedSkills"
                                        :checked="formData.userSelectedSkills.includes(motion)" :value="index"
                                        :id="motion" />
                                    <label class="form-check-label" :for="motion">{{ motion }}</label>
                                    <span v-for="error in v$.availableDays.$errors" :key="error.$uid" class="error-red">
                                        {{ error.$message }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3" v-if="userBasedSkillList.cloudcomputing">
                                <label for="days" class="form-label"><b>Cloud computing</b>
                                </label><br>
                                <div class="form-check form-check-inline"
                                    v-for="(cloudcomputing, index) in userBasedSkillList.cloudcomputing">
                                    <input type="checkbox" class="form-check-input" v-model="formData.userSelectedSkills"
                                        :checked="formData.userSelectedSkills.includes(cloudcomputing)" :value="index"
                                        :id="cloudcomputing" />
                                    <label class="form-check-label" :for="cloudcomputing">{{ cloudcomputing }}</label>
                                    <span v-for="error in v$.availableDays.$errors" :key="error.$uid" class="error-red">
                                        {{ error.$message }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <!-- {{ formData.workPreference }} -->
                                <label class="form-label"><b>Location preferences</b></label><br>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="wfh" type="checkbox"
                                        checked="formData.workPreference.includes('wfh')" value="wfh"
                                        v-model="formData.workPreference">
                                    <label class="form-check-label" for="wfh">Work from home </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="onsite" type="checkbox"
                                        checked="formData.workPreference.includes('onsite')" value="onsite"
                                        v-model="formData.workPreference">
                                    <label class="form-check-label" for="onsite">Onsite</label>
                                </div>
                            </div>
                            <span v-for="error in v$.workPreference.$errors" :key="error.$uid" class="error-red">
                                {{ error.$message }}
                            </span>

                            <div class="mb-3" v-if="formData.workPreference.includes('onsite')">
                                <p>Since you choose <b>onsite</b>, Please choose the places where you can work onsite</p>

                                <div class="card" style="background-color:;overflow-y: scroll;max-height: 150px;">
                                    <div class="card-body shadow-sm">
                                        <div class="row">
                                            <label class="form-label">
                                            </label>
                                            <div class="form-check form-check-inline" v-for="(place, index) in places"
                                                :key="index">
                                                <input class="form-check-input" :id="place.name" type="checkbox"
                                                    :checked="formData.userSelectedPlaces.includes(place.id)"
                                                    v-model="formData.userSelectedPlaces" :value="place.id">
                                                <label class="form-check-label" :for="place.name">{{ place.name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="text-center mt-3">
                            <button class="btn btn-light" type="submit" :class="{ 'loading': isSuccess }"
                                :disabled="isSuccess">
                                <span v-if="!isSuccess">Save Profile</span>
                                <span v-else> Saving...<i class="fas fa-spinner fa-spin"></i></span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<!-- https://tldv.io/ -->
<script setup>
import { ref, onMounted, computed } from 'vue';
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, helpers } from "@vuelidate/validators"
import axios from 'axios'
import Header from './Header.vue'
import ProfileEditLoading from './components/ProfileEditLoading.vue';
import { useUserStore } from '@/stores/user'

const userStore = useUserStore()

const files = ref([]);
const myImage = ref(null)
const profileImage = ref('')
const status = ref(false)
const githubFiledErrorMessage = ref('')
const userBasedSkillList = ref([])//[{}]
const progress = ref('')
const expertise = ref('')
const address = ref('')
const places = ref([])
const isLoading = ref(false);
const showOptionPlaces = ref(false)
const districts = ref([
    "Achham",
    "Arghakhanchi",
    "Baglung",
    "Baitadi",
    "Bajhang",
    "Bajura",
    "Banke",
    "Bara",
    "Bardiya",
    "Bhaktapur",
    "Bhojpur",
    "Chitwan",
    "Dadeldhura",
    "Dailekh",
    "Dang",
    "Darchula",
    "Dhading",
    "Dhankuta",
    "Dhanusa",
    "Dholkha",
    "Dolpa",
    "Doti",
    "Eastern Rukum",
    "Gorkha",
    "Gulmi",
    "Humla",
    "Ilam",
    "Jajarkot",
    "Jhapa",
    "Jumla",
    "Kailali",
    "Kalikot",
    "Kanchanpur",
    "Kapilvastu",
    "Kaski",
    "Kathmandu",
    "Kavrepalanchok",
    "Khotang",
    "Lalitpur",
    "Lamjung",
    "Mahottari",
    "Makwanpur",
    "Manang",
    "Morang",
    "Mugu",
    "Mustang",
    "Myagdi",
    "Nawalpur",
    "Nuwakot",
    "Okhaldhunga",
    "Palpa",
    "Panchthar",
    "Parasi",
    "Parbat",
    "Parsa",
    "Pyuthan",
    "Ramechhap",
    "Rasuwa",
    "Rautahat",
    "Rolpa",
    "Rupandehi",
    "Salyan",
    "Sankhuwasabha",
    "Saptari",
    "Sarlahi",
    "Sindhuli",
    "Sindhupalchok",
    "Siraha",
    "Solukhumbu",
    "Sunsari",
    "Surkhet",
    "Syangja",
    "Tanahun",
    "Taplejung",
    "Terhathum",
    "Udayapur",
    "Western Rukum"
]);


const filterDistricts = () => {
    showOptionPlaces.value = true
}

const filteredDistricts = computed(() => {
    return districts.value.filter((district) => {
        return district.toLowerCase().includes(formData.value.search.toLowerCase());
    });
})

const selectDistrict = (district) => {
    formData.value.search = district;
    showOptionPlaces.value = false;
}

const containsUser = (value) => {
    //  return value.includes("user")
}

const mustIncludeOne = () => {
    if (formData.availableDays.length > 0) {
        return true;
    }
}

const days = ref([
    {
        id: 1,
        name: 'Monday'
    },
    {
        id: 2,
        name: 'Tuesday'
    },
    {
        id: 3,
        name: 'Wednesday'
    },
    {
        id: 4,
        name: 'Thursday'
    },
    {
        id: 5,
        name: 'Friday'
    },
    {
        id: 6,
        name: 'Saturday'
    },
    {
        id: 7,
        name: 'Sunday'
    },
]);
const fn = ref('');
const formData = ref({
    firstname: '',
    lastname: '',
    about: '',
    github: '',
    experience: '',
    roleLevel: '',
    availableDays: [],
    workType: [],
    workPreference: [],
    skills: [],
    userSelectedSkills: [],
    userSelectedPlaces: [],
    search:''
})

const onlyString = () => {

}
const checkGithub = () => {
    if (formData.value.github != '') {
        if (formData.value.github.includes('github.com')) {
            githubFiledErrorMessage.value = ''
            return true;
        } else {
            githubFiledErrorMessage.value = 'Please provide your Github profile link.'
            return false;
        }

    }
    githubFiledErrorMessage.value = '';

    return true;
}

const rules = {
    github: {
        checkGithub
    },
    firstname: {
        required
        //required:helpers.regex(/^([^0-9]*)$/)
        // minLength: minLength(10),
        // containsUser: helpers.withMessage("the field must contain firstname",
        // containsUser
        //, ),
    },
    lastname: {
        required
    },
    about: {
        required,
        minLength: minLength(2)
    },
    availableDays: {
        required: helpers.withMessage('Your availability must be atleast one day', required),
        // minLength: minLength(2), //min lenght is fine, can remove mustIncludeOne
        // mustIncludeOne
    },
    workType: {
        required: helpers.withMessage('Please select at least one work type', required),
    },
    workPreference: {
        required: helpers.withMessage('Please select your work preferences', required),
        // minLength: minLength(1)
    }
}
const v$ = useVuelidate(rules, formData);

const formOnSubmit = async () => {

    const result = await v$.value.$validate();
    if (result) {
        // alert('success')
        axios.post('/user/profile', { formData: formData.value }).then((response) => {
            console.log(response.data)
        }).catch((error) => {
            console.log(error)
        })
    } else {
        const el = document.getElementById('firstname')
        el.scrollIntoView({ behavior: 'smooth' });
        alert('error')
    }
}

onMounted(() => {
    isLoading.value = true
    axios.get('/userbased-skills').then((response) => {
        userBasedSkillList.value = response.data
        console.log('skill', response.data)
        isLoading.value = false

    }).catch((error) => {
        console.log('error in fetching skills', error)
    })

    axios.get('/places').then((response) => {
        places.value = response.data  //get all places
        console.log(places.value)
    }).catch((error) => alert('unable to fetch places'))

    setTimeout(() => {
        getUserDetails() //this need to be loaded a bit late then userBasedSkills otherwise our checked for programming does not work
        // this is because our either userBasedSkill[] or below response.data.skills[] will be null array to compare the values, 
        //this makes sure our both arrays has some value to comapre

    }, 500);

})

const getUserDetails = () => {
    axios.get('/user/details').then((response) => {
        formData.value.firstname = response.data.firstname
        formData.value.lastname = response.data.lastname
        formData.value.about = response.data.about
        expertise.value = response.data.expertise
        address.value = response.data.userAddress
        formData.value.experience = response.data.experience
        formData.value.roleLevel = response.data.roleLevel
        formData.value.availableDays = response.data.availableDays
        formData.value.workType = response.data.workType
        formData.value.userSelectedSkills = response.data.skills
        profileImage.value = response.data.profileImage
        formData.value.workPreference = response.data.workPreference
        formData.value.places = response.data.places
        formData.value.userSelectedPlaces = response.data.userSelectedPlaces
        formData.value.search = response.data.address //user address
        console.log(response.data.userSelectedPlaces)
    });
}

const enableEditing = () => {
    document.getElementById('fname').disabled = false;
    document.getElementById('lname').disabled = false;
}

const updateProfilePicture = (e) => {
    status.value = true
    const image = myImage.value.files[0];
    const formData = new FormData();
    formData.append('image', image)
    axios.post('/profileImage/upload', formData, {
        headers: {
            'Content-Type': 'multipart-formdata'
        },
        onUploadProgress: (progressEvent) => {
            progress.value = Math.round(
                (progressEvent.loaded * 100) / progressEvent.total
            );
        },
    }).then((response) => {
        status.value = false
        profileImage.value = response.data.url

    }).catch((error) => {
        document.getElementById('errorUploadingImage').innerText = 'Error in uploading image';
        console.log(error)
    })
}
</script>
<style scoped>
/**upload profile pic */
.image-container {
    position: relative;
}

.image-upload-label {
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background-color: #000;
    border-radius: 5px;
    cursor: pointer;
}

.image-upload-label i {
    margin-right: 10px;
}

.card {
    border: none;
}

.image-upload-input {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.profile-picture img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 3px solid #4a4a4a;
}

/**checkbox */

.form-check-input:checked {
    background-color: #1d1dff;
    border-color: #1d1dff;
}

.btn-light {
    background-color: #1d1dff;
    border-color: #1d1dff;
    color: #fff;
}

.btn-light:hover {
    background-color: #04045bed;
    border-color: #04045bed;
    color: #fff;
}

.image-container:hover .image-upload-label {
    display: block;
}

/**upload profile pic ends */
/* pinner button css  */
.profile-button.loading {
    position: relative;
    overflow: hidden;
}

.profile-button.loading i.fa-spinner {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.profile-button.loading i.fa-spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* pinner button css ends */
.error-red {
    color: red;
}

.btn-outline-info.active {
    color: #f3f3f3;
}

.loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 2px solid blue;
    border-right: 2px solid green;
    border-bottom: 2px solid red;
    border-left: 2px solid pink;
    width: 30px;
    height: 30px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
<style scoped></style>