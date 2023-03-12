<template>
    <div class="col-md-8">
        <div class="card">
            <RouterLink to="/dashboard">das</RouterLink>
            <div class="card-header" id="app">Login
                {{ userStore.userId }}{{ userStore.userRole }}
            </div>

            <div class="card-body">
                <form method="POST" @submit.prevent="login">

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <input id="email" v-model="email" type="email" class="form-control " name="email" required
                                autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <input id="password" v-model="password" type="password" class="form-control">

                        </div>
                    </div>



                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Login

                            </button>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue'
import { useUserStore } from '@/stores/user'
import { useRouter } from 'vue-router';

const email = ref('');
const password = ref('');

const router = useRouter();
const userStore = useUserStore()
const login = async () => {
    await userStore.login({ email: email.value, password: password.value });
    router.push({ path: '/dashboard' })
}

</script>

 