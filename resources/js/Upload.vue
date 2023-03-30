<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="image-container">
                        <input type="file" ref="myImage" id="image-upload" class="form-control"
                            @change="updateProfilePicture()">
                        <p v-if="status">
                        <div class="progress mt-5">
                            <div class="progress-bar" role="progressbar" :style="{ width: `${progress}%` }"
                                :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                                {{ progress }}%
                            </div>
                        </div>
                        <br>
                        Uploading...<br>
                        </p>
                        <br>
                        <p id="errorUploadingImage"></p>
                        <img class="mx-auto d-block" :src="profileImage">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
const progress = ref('')
const status = ref(false)
const profileImage = ref('')
const myImage = ref(null)

const updateProfilePicture = () => {
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