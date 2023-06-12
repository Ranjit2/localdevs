<template>
    <div class="container">
    <div id="dashboard mt-5" class="medium-font">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <Header />
                <ExperienceLoading v-if="isProcessing" />
                <div v-if="successMessage">
                    <p class="mt-2" style="font-size: 18px; color:#1d1dff;">
                        <i class="bi bi-check2-circle"></i> Work experience successfully
                        updated
                    </p>
                </div>
                <div v-if="deleteSuccess">
                    <p class="mt-2" style="font-size: 18px; color:#1d1dff;">
                        <i class="bi bi-check2-circle"></i>  Work experience successfully removed
                    </p>
                </div>
                <div class="d-flex align-items-center" v-if="!isProcessing">
                    <h3 v-if="!isProcessing" class="mt-3">Work Experience</h3>

                    <h4 class="me-auto">{{ employment.length < 1 ? 'Add your employment history here' : '' }}</h4>
                        <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add-expertise-1"
                                style="background-color:  #1d1dff;" @click="addExpertise">Add Experience
                        </button>
                </div>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="add-expertise-1"
                    aria-labelledby="add-expertise-label" style="width: 30%;">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="add-expertise-label">Add Expertise</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <form>
                            <div class="mb-3">
                                <label for="expertise" class="form-label">Job title</label>
                                <input type="text" class="form-control" v-model="formData.jobTitle" @input="filterResults"
                                    autocomplete="off" placeholder="e.g. Software engineer">
                                <span v-for="error in v$.jobTitle.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label for="expertise" class="form-label">Company name</label>
                                <input type="text" class="form-control" v-model="formData.companyName">
                                <span v-for="error in v$.companyName.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label for="expertise" class="form-label">Company location</label>
                                <input type="text" class="form-control" v-model="formData.companyLocation">
                                <span v-for="error in v$.companyLocation.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label for="expertise" class="form-label">Start date</label>
                                <input type="date" class="form-control" id="expertise" placeholder="yyyy-mm-dd"
                                    v-model="formData.startDate">
                                <span v-for="error in v$.startDate.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>
                            <div class="form-check-inline">
                                <input type="checkbox" class="form-check-input" id="work" v-model="formData.isWorking"
                                    @change="isWorkingHere">
                                <label class="form-check-label" for="work">I am currently working here</label>
                            </div>
                            <div class="mb-3 " v-if="showEndDate">
                                <label for="expertise" class="form-label">End date</label>
                                <input type="date" class="form-control" id="expertise" v-model="formData.endDate"
                                    placeholder="yyyy-mm-dd">
                                <p v-if="disabledMessage" class="error-red">Please ensure that the end date is after the
                                    start date.</p>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="description" class="form-label">Explain about your roles</label>
                                <textarea v-model="formData.description" class="form-control" cols="8" rows="8"
                                    placeholder=""></textarea>
                            </div>
                            <div class="text-center">
                                <button :disabled="isProcessing || disableSubmit" class="btn btn-default btn-lg px-5 mt-2"
                                    @click.prevent="submitForm">
                                    {{ isProcessing ? "Saving" : "Save" }}
                                    <span v-if="isProcessing" class="spinner-border spinner-border-sm"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Edit employment history -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="edit-expertise"
                    data-bs-backdrop="static"
                    aria-labelledby="edit-expertise-label" style="width: 30%;">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="edit-expertise-label">Edit Expertise</h5>
                        <button @click="closeButton" type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">

                        </button>
                    </div>
                    <div class="offcanvas-body">
                        <form>
                            <div class="mb-3">
                                <label for="expertise" class="form-label">Job title</label>
                                <input type="text" class="form-control" v-model="formData.jobTitle" autocomplete="off"
                                    placeholder="e.g. Software engineer">

                                <span v-for="error in v$.jobTitle.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label for="expertise" class="form-label">Company name</label>
                                <input type="text" class="form-control" v-model="formData.companyName">
                                <span v-for="error in v$.companyName.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label for="expertise" class="form-label">Company location</label>
                                <input type="text" class="form-control" v-model="formData.companyLocation">
                                <span v-for="error in v$.companyLocation.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label for="expertise" class="form-label">Start date</label>
                                <input type="date" class="form-control" id="expertise" placeholder="yyyy-mm-dd"
                                    v-model="formData.startDate">
                                <span v-for="error in v$.startDate.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>
                            <div class="form-check-inline">
                                <input type="checkbox" class="form-check-input" id="work" v-model="formData.isWorking"
                                    @change="isWorkingHere">
                                <label class="form-check-label" for="work">I am currently working here</label>
                            </div>
                            <div class="mb-3 " v-if="showEndDate">
                                <label for="expertise" class="form-label">End date</label>
                                <input type="date" class="form-control" id="expertise" v-model="formData.endDate"
                                    placeholder="yyyy-mm-dd">
                                <p v-if="disabledMessage" class="error-red">Please ensure that the end date is after the
                                    start date.</p>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="description" class="form-label">Explain about your roles</label>
                                <textarea v-model="formData.description" class="form-control" cols="8" rows="8"
                                    placeholder=""></textarea>
                            </div>
                            <div class="text-center">
                                <button :disabled="isProcessing || disableSubmit" class="btn btn-default btn-lg px-5 mt-2"
                                    @click.prevent="submitForm">
                                    {{ isProcessing ? "Updating" : "Update" }}
                                    <span v-if="isProcessing" class="spinner-border spinner-border-sm"></span>
                                </button>

                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-2" v-for="job in employment" v-if="!isProcessing">
                    <div class="card-body">
                        <h2>{{ job.job_title }}</h2>
                        <p>{{ job.start_date }} to {{ job.isWorking == 1 ? 'present' : job.end_date }} -  {{ getMonthorYear(job.start_date, job.end_date) }}</p>
                        <p>{{ job.description }}</p>
                        <br>

                        <button class="btn btn-primary" id="edit-expertise-toggle" data-bs-toggle="offcanvas"
                            data-bs-target="#edit-expertise" @click="showDataInForm(job.id)"
                            style="background-color:  #1d1dff;">
                            Edit
                        </button>&nbsp;

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            :data-bs-target="`#staticBackdrop${job.id}`">
                            Remove
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" :id="`staticBackdrop${job.id}`" 
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete confirmation</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        Are you sure you want to delete ?
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                            @click="deleteJob(job.id)">Delete</button>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script setup>
import Header from './Header.vue'
import { onMounted, ref, computed } from 'vue';
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, helpers, email } from "@vuelidate/validators"
import ExperienceLoading from './components/ExperienceLoading.vue'

import axios from 'axios';


const showEndDate = ref(true)
const disabledMessage = ref(false)
const isProcessing = ref(false)
const employment = ref([])
const successMessage = ref(false)
const start_date = ref('')
const end_date = ref('')
const deleteSuccess = ref(false)

const formData = ref({
    jobTitle: '',
    companyName: '',
    companyLocation: '',
    startDate: '',
    endDate: '',
    isWorking: false,
    description: '',
    jobId: ''
})

const rules = {
    jobTitle: {
        required: helpers.withMessage('Please enter a Job title', required),
    },
    startDate: {
        required: helpers.withMessage('Please enter a start date', required),
    },
    companyName: {
        required: helpers.withMessage('Please enter a company name', required)
    },
    companyLocation: {
        required: helpers.withMessage('Please enter a company location', required)
    }
};

const v$ = useVuelidate(rules, formData);
const submitForm = async () => {
    const result = await v$.value.$validate();
    if (result) {
        isProcessing.value = true;
        axios.post('/user/employment/history', { formData: formData.value }).then((response) => {
            getEmploymentHistory()
            successMessage.value = true;
            isProcessing.value = false
            deleteSuccess.value = false;

        }).catch((error) => {

            alert('error while updating. Please refresh the page and try again')
            isProcessing.value = false
        })
    }
}

const disableSubmit = computed(() => {
    if (showEndDate.value) {
        const startDate = new Date(formData.value.startDate);
        const endDate = new Date(formData.value.endDate);
        if (startDate >= endDate) {

            disabledMessage.value = true;
            return startDate >= endDate;

        } else {
            disabledMessage.value = false;

        }
    } else {
        return false;
    }
});

const getMonthorYear = (startDate, endDate) => {
    const start = new Date(startDate);
    const end = endDate ? new Date(endDate) : new Date();
    const years = end.getFullYear() - start.getFullYear();
    const months = (years * 12) + (end.getMonth() - start.getMonth());
    if (months < 12) {
        return `${months} months`;
    } else if (months % 12 === 0) {
        const y = months / 12;
        return `${y} ${y === 1 ? 'year' : 'years'}`;
    } else {
        const y = Math.floor(months / 12);
        const m = months % 12;
        return `${y} ${y === 1 ? 'year' : 'years'}, ${m} ${m === 1 ? 'month' : 'months'}`;
    }
};


onMounted(() => {
    getEmploymentHistory()
})

const getEmploymentHistory = () => {
    isProcessing.value = true;
    axios.get('/user/employment/history').then((response) => {
        employment.value = response.data
        start_date.value = response.data.start_date
        end_date.value = response.data.end_date
        isProcessing.value = false
    }).catch((error) => {
        alert('error while fetching. Please refresh the page and try again')
    })
};

const showDataInForm = (jobId) => {
    employment.value.filter(job => job.id == jobId).forEach(item => {
        formData.value.jobTitle = item.job_title
        formData.value.companyName = item.company_name
        formData.value.companyLocation = item.company_location
        formData.value.startDate = item.start_date
        formData.value.endDate = item.end_date
        formData.value.isWorking = item.is_working,
        formData.value.jobId = jobId
    })
}

const deleteJob = (id) => {
    isProcessing.value = true;
    axios.post('/delete/employment/history', { jobId: id }).then((response) => {
        isProcessing.value = false
        getEmploymentHistory()
        deleteSuccess.value = true
        successMessage.value = false;
    }).catch((error) => {
        alert('error while deleting. Please refresh the page and try again')
        isProcessing.value = false
    })
}

const isWorkingHere = (e) => {
    if (e.target.checked) {
        showEndDate.value = false
        formData.value.endDate = ''
    } else {
        showEndDate.value = true
    }
}

const closeButton = () => {
    formData.value.jobTitle = ""
    formData.value.companyName = ""
    formData.value.companyLocation = ""
    formData.value.startDate = ""
    formData.value.endDate = ""
    formData.value.description = ""
    formData.value.jobId = ""
}
</script>

<style scoped>
.btn-default {
    background-color: #1d1dff;
    color: #fff;
}

.error-red {
    color: red;
}
</style>