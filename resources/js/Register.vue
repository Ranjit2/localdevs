<template>
    <div>
        <!-- <div class="progress" v-if="showProgress">
            <div class="progress-bar" role="progressbar" :style="{ width: formProgress + '%' }"></div>
        </div> -->
        <form @submit.prevent="submitForm">
            <div v-if="currentStep === 1">
                <form>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" v-model="formData.firstName">
                            <span v-for="error in v$.firstName.$errors" :key="error.$uid" class="error-red">
                                {{ error.$message }}
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" v-model="formData.lastName">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" v-model="formData.email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" v-model="formData.password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button type="button" class="btn btn-primary" @click="goNext">Next</button>
                    </div>
                </form>
            </div>
            <div v-else-if="currentStep === 2">
                <div class="form-group">
                    What best describes you ?<br>
                    <div v-for="e in talents">
                        <input type="radio" 
                        v-model="formData.expertise" :value="e.name"/>{{ e.name }}
                    </div>
                </div>
                <button v-if="currentStep > 1" type="button" class="btn btn-primary" @click="goPrevious">Previous</button>
                &nbsp;
                <button type="submit" class="btn btn-primary" @click.prevent="submitForm">
                    Submit
                </button>
            </div>

        </form>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, helpers } from "@vuelidate/validators"
import axios from 'axios';

const currentStep = ref(1);
const showProgress = ref(true);
const formData = ref({
    firstName: '',
    lastName: '',
    email: '',
    password: '',
    expertise:''
});

const talents = ref([
    {
        id:1,
        name:'developer'
    },
    {
        id:2,
        name:'designer'
    },
    {
        id:3,
        name:'motion'
    },
    {
        id:4,
        name:'pm'
    }
]);
const rules = {
    firstName: {
        required:helpers.withMessage('Please enter your first name', required),
        //required:helpers.regex(/^([^0-9]*)$/)
        // minLength: minLength(10),
        // containsUser: helpers.withMessage("the field must contain firstname",
        // containsUser
        //, ),
    }
}
const v$ = useVuelidate(rules, formData);
const goNext = async () => {
    const result = await v$.value.$validate();
    if (result) {
        currentStep.value++;
    }
}

const goPrevious = () => {
    currentStep.value--;
}

const submitForm = () => {
    axios.post('/register',{formData:formData.value}).then((response) => {
        console.log(response.data)
    }).then((res) => {
        window.location.href = '/home/'
    })
}

computed({
    formProgress() {
        return (this.currentStep / 3) * 100;
    },
    isValid() {
        // Validate form fields
    }
})

</script>
<style>
.error-red {
    color: red;
}
</style>
