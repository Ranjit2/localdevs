<template>
    <h1 class="mt-5 text-center animate__animated animate__zoomInUp">👋Hello there! </h1>
    <form @submit.prevent="submitForm">
        <div class="card mt-3 animate__animated animate__zoomInUp">
            <div class="card-body">
                
                <div class="col-md-4" style="margin-left: 190px;">
                    <div class="form-check d-inline-block">
                        <label class="d-inline">I want to register as:  </label>
                    </div>
                    <div class="form-check d-inline-block" style="margin-left: 25px;">
                        <input v-model="formData.registrationType" type="radio"  class="form-check-input" id="job-seeker" name="registration-type" @click="registerOption('company')"
                        value="company">
                        <label class="form-check-label" for="job-seeker">Company</label>
                    </div>
                    <div class="form-check d-inline-block" style="margin-left: 35px;">
                        <input v-model="formData.registrationType" type="radio" class="form-check-input" id="employer" name="registration-type"  @click="registerOption('individual')"
                        value="individual">
                        <label class="form-check-label" for="employer">Individual</label>
                    </div>
                </div>

                <br>
                <div v-if="isCompany==true">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label for="firstName">Company name:</label>
                        <input type="text" class="form-control" id="companyName" v-model="formData.companyName">
                        <span v-for="error in v$.companyName.$errors" :key="error.$uid" class="error-red">
                            {{ error.$message }}
                        </span>
                    </div>    
                    <div class="col-md-4">
                        <label for="firstName">Company location:</label>
                        <input type="text" class="form-control" id="clocation" v-model="formData.companyLocation">
                        <span v-for="error in v$.companyLocation.$errors" :key="error.$uid" class="error-red">
                            {{ error.$message }}
                        </span>
                    </div> 
                      
                </div>


                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label for="firstName">Email address</label>
                        <input type="text" class="form-control" id="firstName" v-model="formData.companyEmail">
                        <span v-for="error in v$.companyEmail.$errors" :key="error.$uid" class="error-red">
                            {{ error.$message }}
                        </span>
                    </div>    
                    <div class="col-md-4">
                        <label for="firstName">Contact number:</label>
                        <input type="text" class="form-control" id="firstName" v-model="formData.companyNumber">
                        <span v-for="error in v$.companyNumber.$errors" :key="error.$uid" class="error-red">
                            {{ error.$message }}
                        </span>
                    </div>  
                </div>
            </div>

            <div v-if="isCompany==false">
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
                        <input type="email" name="emailAddress" class="form-control" id="emailAddress" v-model="formData.emailAddress">
                        <span v-for="error in v$.emailAddress.$errors" :key="error.$uid" class="error-red">
                            {{ error.$message }}
                        </span>
                    </div>
                    <div class="col-md-4">
                        <label for="password">contact number</label>
                        <input type="password" class="form-control" id="password" v-model="formData.contactNumber">
                        <!-- <span v-for="error in v$.contactNumber.$errors" :key="error.$uid" class="error-red">
                            {{ error.$message }}
                        </span> -->
                    </div>
                </div>
            </div>
                <div class="text-center mt-5">
                    <button v-if="!isProcessing" type="submit" class="btn btn-lg btn-light" @click="validateSubmission">
                        Join CoderMandu
                    </button>

                    <button v-else type="submit" class="btn btn-lg btn-light" disabled>
                        <i class="fa fa-spinner fa-spin"></i>
                        <span class="processing-text">Processing <i class="fas fa-spinner"></i></span>

                    </button>
                    <br><br>
                    <a class="mt-5" href="">Looking to hire?</a>
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

const showProgress = ref(true);
const isProcessing = ref(false);
const isCompany = ref(true);

const formData = ref({
    firstName: '',
    lastName: '',
    emailAddress: '',
    contactNumber: '',
    companyName:'',
    companyLocation:'',
    companyEmail:'',
    companyNumber:'',
    registrationType:''
});

const registerOption = (value) => {
    if (value == 'company') {
        isCompany.value = true;
    }
    if (value == 'individual') {
        isCompany.value = false;
    }
}


const onlyLettersAndSpaces = (value) => {
    const pattern = /^[a-zA-Z\s]*$/;
    return pattern.test(value);
}

const firstName = () => {
    return {
        required: helpers.withMessage('Please enter your first name', required),
        custom: helpers.withMessage("First name must contain only letters", onlyLettersAndSpaces),
        minLength: minLength(2)  
    };
};
const lastName = () => {
    return {
        required: helpers.withMessage('Please enter your last name', required),
        custom: helpers.withMessage("Last name must contain only letters", onlyLettersAndSpaces),
        minLength: minLength(2)
    };
};
const emailAddress = () => {
    return {
        required: helpers.withMessage('Please enter your email address', required),
        email
    };
};
const password = () => {
    return {
        required: helpers.withMessage('Please enter your password', required),
        minLength: minLength(8)
    };
};

const companyName = () => {
    return {
        required: helpers.withMessage('Please enter your company name', required),
    };
};

const companyLocation = () => {
    return {
        required: helpers.withMessage('Please enter your company location', required),
    };
};

const isCompanyEmail = (value) => {
  if (!value) {
    return false;
  }
  
  const domains = ['@gmail.com', '@yahoo.com', '@hotmail.com'];
  const emailDomain = value.substring(value.lastIndexOf("@"));

  return !domains.includes(emailDomain);
}

const companyEmail = () => {
  return {
    required: helpers.withMessage('Please enter your company email', required),
    email,
    isCompanyEmail
  };
};

const companyNumber = () => {
    return {
        required: helpers.withMessage('Please enter your company contact number', required),
    };
};

const rules = computed(() => {
    return {
        firstName: isCompany.value ? {} : firstName(),
        lastName: isCompany.value ? {} : lastName(),
        emailAddress: isCompany.value ? {} : emailAddress(),
        password: isCompany.value ? {} : password(),

        companyName: isCompany.value==true ? companyName() : {},
        companyLocation: isCompany.value==true ? companyLocation() : {},
        companyEmail: isCompany.value==true ? companyEmail() : {},
        companyNumber: isCompany.value==true ? companyNumber() : {},
    }
})

const v$ = useVuelidate(rules, formData);
const validateSubmission = async () => {
    const result = await v$.value.$validate();
    if (result) {
       // alert('pass')
        // currentStep.value++;
    }
}

const submitForm = () => {
   // alert('ok')
    isProcessing.value = true;
    axios.post('/company/register', { formData: formData.value }).then((response) => {
       // window.location.href = '/home'
       isProcessing.value = false;
       alert('success')
    }).catch((res) => {
        alert('error')
        isProcessing.value = false;
    })
}


</script>
<style scoped>
.error-red {
    color: red;
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

</style>
