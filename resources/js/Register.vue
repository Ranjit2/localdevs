<template>
    <form @submit.prevent="submitForm">
        <div class="card mt-5">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" v-model="formData.firstName">
                        <span v-for="error in v$.firstName.$errors" :key="error.$uid" class="error-red">
                            {{ error.$message }}
                        </span>
                    </div>
                    <div class="col-md-4">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" v-model="formData.lastName">
                        <span v-for="error in v$.lastName.$errors" :key="error.$uid" class="error-red">
                            {{ error.$message }}
                        </span>
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col-md-4">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" v-model="formData.email">
                        <span v-for="error in v$.email.$errors" :key="error.$uid" class="error-red">
                            {{ error.$message }}
                        </span>
                    </div>
                    <div class="col-md-4">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" v-model="formData.password">
                        <span v-for="error in v$.password.$errors" :key="error.$uid" class="error-red">
                            {{ error.$message }}
                        </span>
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col-md-8">
                        <label for="password">What best describes you ?</label><br>
                        <div class="form-check form-check-inline mt-1" v-for="talent in talents">
                            <input type="radio" class="form-check-input" :id="talent.name" name="type"
                                v-model="formData.expertise" :value="talent.short">
                            <label class="form-check-label" :for="talent.name">{{ talent.name }}</label>
                        </div>
                        <br>
                        <span v-for="error in v$.expertise.$errors" :key="error.$uid" class="error-red ">
                            {{ error.$message }}
                        </span>
                    </div>

                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-lg btn-light" @click="validateSubmission">Join CoderMandu</button>
                </div>

            </div>
        </div>
    </form>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, helpers, email } from "@vuelidate/validators"
import axios from 'axios';

const currentStep = ref(1);
const showProgress = ref(true);
const formData = ref({
    firstName: '',
    lastName: '',
    email: '',
    password: '',
    expertise: ''
});

const talents = ref([
    {
        id: 1,
        name: 'Developer',
        short: 'developer'
    },
    {
        id: 2,
        name: 'Designer',
        short: 'designer'
    },
    {
        id: 3,
        name: 'Motion Designer',
        short: 'motion'
    },
    {
        id: 4,
        name: 'Project Manager',
        short: 'pm'
    }
]);

const onlyLettersAndSpaces = (value) => {
    const pattern = /^[a-zA-Z\s]*$/;
    return pattern.test(value);
}

const rules = {
    firstName: {
        required: helpers.withMessage('Please enter your first name', required),
        custom: helpers.withMessage("First name must contain only letters", onlyLettersAndSpaces),
        minLength: minLength(2)
    },
    lastName: {
        required: helpers.withMessage('Please enter your last name', required),
        custom: helpers.withMessage("Last name must contain only letters", onlyLettersAndSpaces),
        minLength: minLength(2)
    },
    email: {
        required: helpers.withMessage('Please enter your email address', required),
        email
    },
    password: {
        required: helpers.withMessage('Please enter your password', required),
        minLength: minLength(8)
    },
    expertise: {
        required: helpers.withMessage('Please select your expertise', required)
    }
}
const v$ = useVuelidate(rules, formData);
const validateSubmission = async () => {
    const result = await v$.value.$validate();
    if (result) {
        // currentStep.value++;
    }
}

const goPrevious = () => {
    currentStep.value--;
}

const submitForm = () => {
    axios.post('/register', { formData: formData.value }).then((response) => {
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
