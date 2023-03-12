<template>
    <!-- <Header /> -->
    <div class="container rounded bg-white mt-5">
        <RouterLink to="/dashboard">Dashboard</RouterLink>
        userID:{{ userStore.userId }}
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <form action="">
                        <input type="file" ref="myImage" class="form-control" @change="updateProfilePicture()">
                        <p id="errorUploadingImage"></p>
                    </form>
                    <p v-if="status">Uploading...<br>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" :style="{ width: `${progress}%` }"
                            :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                            {{ progress }}%
                        </div>
                    </div>
                    </p>
                    <img v-else class="bordered-image" :src="profileImage" width="90"
                        style="border:1px solid #ccc;border-radius: 50%;">
                    <span class="font-weight-bold">John Doe</span>
                    <span class="text-black-50">john_doe12@bbb.com</span>
                    <span>United States</span>
                </div>
            </div>
            <div class="col-md-8">
                <form @submit.prevent="formOnSubmit" method="POST">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-row align-items-center back"><i
                                    class="fa fa-long-arrow-left mr-1 mb-1"></i>
                                <h6>Back to Profile</h6>
                            </div>
                            <h6 class="text-right">Edit Profile</h6>
                        </div>

                        <div class="row mt-2">
                            <!-- {{ formData }} -->
                            <hr>
                            <!-- {{ formData.userBasedSkillList }} -->
                            <div class="col-md-6" id="firstname">First name

                                <input type="text" class="form-control" id="fname" placeholder="first name"
                                    v-model="formData.firstname" disabled>
                            </div>
                            <span v-for="error in v$.firstname.$errors" :key="error.$uid" class="error-red">
                                {{ error.$message }}
                            </span>

                            <div class="col-md-6">Last name
                                <input type="text" v-model="formData.lastname" id="lname" class="form-control"
                                    placeholder="Doe" disabled>
                            </div>

                            <span v-for="error in v$.lastname.$errors" :key="error.$uid" class="error-red">
                                {{ error.$message }}
                            </span>
                            <a href="#" @click.prevent="enableEditing">enable editing</a>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">About me
                                <textarea class="form-control" v-model="formData.about" cols="" rows=""></textarea>
                            </div>
                            <span v-for="error in v$.about.$errors" :key="error.$uid" class="error-red">
                                {{ error.$message }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="days" class="form-label">Days Available</label><br>
                            <div class="form-check form-check-inline" v-for="(day, index) in days">
                                <input class="form-check-input" type="checkbox" v-model="formData.availableDays"
                                    :value="day.name" :id="index" :checked="formData.availableDays.includes(day.name)">
                                <label class="form-check-label" :for="index">{{ day.name }}</label>
                                <span v-for="error in v$.availableDays.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>
                        </div>


                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label pt-2">
                                Github
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center">
                                <div class="row w-100">
                                    <div class="col-md d-flex">
                                        <div id="fieldset-github" role="group" class="form-group flex-fill">
                                            <!---->
                                            <div class="bv-no-focus-ring">
                                                <input id="input-github" name="github" v-model="formData.github"
                                                    @keyup="formData.github" type="text" placeholder="https://github.com/"
                                                    class="form-control">
                                                <div tabindex="-1" role="alert" aria-live="assertive" aria-atomic="true"
                                                    class="invalid-feedback">Please enter a GitHub handle.</div>
                                                <!---->
                                                <!---->

                                                <p style="color:red"
                                                    v-if="githubFiledErrorMessage && formData.github.length > 3">{{
                                                        githubFiledErrorMessage }}</p>
                                                <span v-for="error in v$.github.$errors" :key="error.$uid"
                                                    class="error-red">
                                                    {{ error.$message }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="days" class="form-label">Work Types *{{ formData.workType }}</label><br>
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
                        <div class="mb-3">
                            <label for="days" class="form-label" v-if="userBasedSkillList.programming">Programming
                                Languages</label><br>
                            {{ formData.userSelectedSkills }}
                            {{ userBasedSkillList.programming }}
                            <div class="form-check form-check-inline"
                                v-for="(programming, index) in userBasedSkillList.programming">
                              
                                <input type="checkbox" class="form-check-input" v-model="formData.userSelectedSkills"
                                    :checked="formData.userSelectedSkills.includes(index)" :value="index"
                                    :id="programming" />
                                <label class="form-check-label" :for="programming">  {{ index }}{{ programming }}</label>
                                <span v-for="error in v$.availableDays.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="days" class="form-label" v-if="userBasedSkillList.framework">Frameworks
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

                        <div class="mb-3">
                            <label for="days" class="form-label" v-if="userBasedSkillList.database">Databases
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

                        {{ userBasedSkillList.motion }}
                        <div class="mb-3" v-if="userBasedSkillList.motion">
                            <label for="days" class="form-label">Motion
                            </label><br>
                            <div class="form-check form-check-inline" v-for="(motion, index) in userBasedSkillList.motion">
                                <input type="checkbox" class="form-check-input" v-model="formData.userSelectedSkills"
                                    :checked="formData.userSelectedSkills.includes(motion)" :value="index" :id="motion" />
                                <label class="form-check-label" :for="motion">{{ motion }}</label>
                                <span v-for="error in v$.availableDays.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="days" class="form-label">Location preference *</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" v-model="formData.workPreference" id="wfh">
                                <label class="form-check-label" for="wfh">Work from home</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" v-model="formData.workPreference"
                                    id="onsite">
                                <label class="form-check-label" for="onsite">Onsite</label>
                            </div>
                        </div>

                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label flex-wrap align-content-center">
                                Available for Work
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center">
                                <div class="row w-100">
                                    <div class="col-md">
                                        <div class="pl-4 ml-1 custom-control custom-checkbox"><input id="is_available"
                                                type="checkbox" name="is_available" aria-required="true"
                                                class="custom-control-input" value="true"><label for="is_available"
                                                class="custom-control-label"></label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5 text-right">
                        <button class="btn btn-primary profile-button" type="submit">
                            Save Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, helpers } from "@vuelidate/validators"
import axios from 'axios'
import Header from './Header.vue'

import { useUserStore } from '@/stores/user'

const userStore = useUserStore()

const files = ref([]);
const myImage = ref(null)
const profileImage = ref('')
const previewImage = ref('')
const status = ref(false)
const githubFiledErrorMessage = ref('')
const userBasedSkillList = ref([])
const progress = ref('')


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
    availableDays: [],
    workType: [],
    workPreference: [],
    skills: [],
    userSelectedSkills: []
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
    }
}
const v$ = useVuelidate(rules, formData);

const formOnSubmit = async () => {

    const result = await v$.value.$validate();
    if (result) {
        alert('success')
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
    axios.get('/userbased-skills').then((response) => {
        userBasedSkillList.value = response.data
        console.log('skill', response.data)
    }).catch((error) => {
        console.log('error in fetching skills', error)
    })

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
        formData.value.availableDays = response.data.availableDays
        formData.value.workType = response.data.workType
        formData.value.userSelectedSkills = response.data.skills
        profileImage.value = response.data.profileImage
        console.log(response.data.skills)
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
        profileImage.value = response.data

    }).catch((error) => {
        document.getElementById('errorUploadingImage').innerText = 'Error in uploading image';
        console.log(error)
    })


}
</script>
<style scoped>
.error-red {
    color: red;
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