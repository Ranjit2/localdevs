<template>
    <div class="container">
        <div class="medium-font">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <Header />
                <SocialLoading v-if="isProcessing" />

                <h3 v-if="!isProcessing" class="mt-3">Social links</h3>
                <div v-if="successMessage">
                    <p class="mt-2" style="font-size: 18px; color:#1d1dff;">
                        <i class="fa fa-spinner fa-spin"></i> <i class="bi bi-check2-circle"></i> Profile successfully
                        updated
                    </p>
                </div>
                <form @submit.prevent="submitForm" v-if="!isProcessing">
                    <div class="card mt-2 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="text" class="form-control" id="website" v-model="formData.website">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="github" class="form-label">GitHub</label>
                                    <input type="text" class="form-control" id="github" v-model="formData.github">
                                    <span v-for="error in v$.github.$errors" :key="error.$uid" class="error-red">
                                        {{ error.$message }}
                                    </span>
                                    <p style="color:red" v-if="githubErrorMessage && formData.github.length > 3">{{
                                        githubErrorMessage }}
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="linkedin" class="form-label">LinkedIn</label>
                                    <input type="text" class="form-control" id="linkedin" v-model="formData.linkedin">
                                    <span v-for="error in v$.linkedin.$errors" :key="error.$uid" class="error-red">
                                        {{ error.$message }}
                                    </span>
                                    <p style="color:red" v-if="linkedInErrorMessage && formData.linkedin.length > 3">{{
                                        linkedInErrorMessage }}
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="behance" class="form-label">Behance</label>
                                    <input type="text" class="form-control" id="behance" v-model="formData.behance">
                                    <span v-for="error in v$.behance.$errors" :key="error.$uid" class="error-red">
                                        {{ error.$message }}
                                    </span>
                                    <p style="color:red" v-if="behanceErrorMessage && formData.behance.length > 3">{{
                                        behanceErrorMessage }}
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dribble" class="form-label">Dribbble</label>
                                    <input type="text" class="form-control" id="dribble" v-model="formData.dribbble">
                                    <span v-for="error in v$.dribbble.$errors" :key="error.$uid" class="error-red">
                                        {{ error.$message }}
                                    </span>
                                    <p style="color:red" v-if="dribbleErrorMessage && formData.dribbble.length > 3">{{
                                        dribbleErrorMessage }}
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dribble" class="form-label">Twitter</label>
                                    <input type="text" class="form-control" id="dribble" v-model="formData.twitter">
                                    <span v-for="error in v$.twitter.$errors" :key="error.$uid" class="error-red">
                                        {{ error.$message }}
                                    </span>
                                    <p style="color:red" v-if="twitterErrorMessage && formData.twitter.length > 3">{{
                                        twitterErrorMessage }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer mt-3 bg-white" style="min-height:60px;">

                        <div class="text-center">
                            <button :disabled="isProcessing" class="btn btn-default btn-lg px-5 mt-2">
                                {{ isProcessing ? "Saving" : "Save" }}
                                <span v-if="isProcessing" class="spinner-border spinner-border-sm"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    </div>
</template>


<script setup>
import { onMounted, ref } from 'vue';
import Header from "./Header.vue"
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, helpers, email } from "@vuelidate/validators"
import SocialLoading from './components/SocialLoading.vue'

import axios from 'axios';

const githubErrorMessage = ref()
const linkedInErrorMessage = ref()
const behanceErrorMessage = ref()
const dribbleErrorMessage = ref()
const twitterErrorMessage = ref()
const successMessage = ref(false)
const isProcessing = ref(false)

const formData = ref({
    website: '',
    github: '',
    linkedin: '',
    behance: '',
    dribbble: '',
    twitter: ''
})

const githubRules = () => {

    if (formData.value.github != '') {
        if (formData.value.github.includes('github.com/')) {
            githubErrorMessage.value = ''
            return true;
        } else {
            githubErrorMessage.value = 'Please provide a valid github profile link.'
            return false;
        }

    }

    githubErrorMessage.value = '';

    return true;
}

const linkedInRules = () => {

    if (formData.value.linkedin != '') {
        if (formData.value.linkedin.includes('linkedin.com/')) {
            linkedInErrorMessage.value = ''
            return true;
        } else {
            linkedInErrorMessage.value = 'Please provide a valid LinkedIn profile link.'
            return false;
        }

    }

    linkedInErrorMessage.value = '';

    return true;
}

const behanceRules = () => {

    if (formData.value.behance != '') {
        if (formData.value.behance.includes('behance.net/')) {
            behanceErrorMessage.value = ''
            return true;
        } else {
            behanceErrorMessage.value = 'Please provide a valid behance profile link.'
            return false;
        }

    }
    behanceErrorMessage.value = '';

    return true;
}

const dribbbleRules = () => {

    if (formData.value.dribbble != '') {
        if (formData.value.dribbble.includes('dribbble.com/')) {
            dribbleErrorMessage.value = ''
            return true;
        } else {
            dribbleErrorMessage.value = 'Please provide a valid dribbble profile link.'
            return false;
        }

    }
    dribbleErrorMessage.value = '';

    return true;
}

const twitterRules = () => {

    if (formData.value.twitter != '') {
        if (formData.value.twitter.includes('twitter.com/')) {
            twitterErrorMessage.value = ''
            return true;
        } else {
            twitterErrorMessage.value = 'Please provide a valid twitter profile link.'
            return false;
        }

    }
    twitterErrorMessage.value = '';

    return true;
}
const rules = {
    linkedin: {
        linkedInRules
    },
    github: {
        githubRules
    },
    behance: {
        behanceRules
    },
    dribbble: {
        dribbbleRules
    },
    twitter: {
        twitterRules
    }
}

const v$ = useVuelidate(rules, formData);
const submitForm = async () => {
    isProcessing.value = true;
    const result = await v$.value.$validate();
    if (result) {
        axios.post('/user/social', { formData: formData.value }).then((response) => {
            successMessage.value = response.data.message
            isProcessing.value = false
          //  localStorage.setItem('socialLinks', JSON.stringify(response.data))
        }).catch((error) => {
            alert('error while updating. Please refresh the broowser and try again')
            isProcessing.value = false
        })
    }
}


onMounted(() => {
    isProcessing.value  = true;
    // const data = localStorage.getItem('socialLinks')
    // if (data) {
    //     formData.value = JSON.parse(data)
    // } else {
        axios.get('/get-user-social').then((response) => {
            formData.value = response.data
            isProcessing.value = false
           // localStorage.setItem('socialLinks', JSON.stringify(response.data))
        });
    //}
})

</script>
<style scoped>
.btn-default {
    background-color: #1d1dff;
    color: #fff;
}
</style>