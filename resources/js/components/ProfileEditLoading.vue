<template>
    <div class="col-md-2"></div>
    <div class="row justify-content-center rounded bg-white">

        <div class="col-md-12">
            <div class="col-md-10">
                <div class="row ">
                    <div class="col-md-6"></div>
                    <div class="col-md-2 row mt-2">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="skeleton-profile-image"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-2 ">
                <div class="col-md-6" id="firstname">
                    <div class="skeleton-fname"></div>

                    <!-- <input type="text" class="form-control bg-secondary placeholder" id="fname" > -->
                </div>
                <div class="col-md-6">
                    <!-- <input type="text"  id="lname" class="form-control bg-secondary placeholder" -->
                    <div class="skeleton-lname"></div>
                </div>
            </div>
            <div class="row mt-3 ">
                <div class="col-md-12">
                    <div class="skeleton-description"></div>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="skeleton-email"></div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="skeleton-password"></div>
                </div>
            </div> -->

            <!-- <div class="row skeleton-loading"> -->
            <div class="row">
                <div class="col-md-4 mt-3">
                    <div class="skeleton-social1"></div>
                    <!-- <input type="text" class="form-control bg-secondary placeholder"> -->
                </div>

                <div class="col-md-4 mt-3">
                    <div class="skeleton-social2"></div>
                    <!-- <input type="text" class="form-control bg-secondary placeholder"> -->
                </div>
                <div class="col-md-4 mt-3">
                    <div class="skeleton-social3"></div>
                    <!-- <input type="text" class="form-control bg-secondary placeholder"> -->
                </div>
            </div>
            <!-- </div> -->

            <div class="mb-3 mt-2 skeleton-loading">
                <label for="days" class="form-label"></label><br>
                <div class="bg-secondary placeholder">

                </div>
                <div class="bg-secondary placeholder">

                </div>
            </div>

            <h5 class="skeleton-loading"></h5>

            <div class="mb-3 skeleton-loading">
                <label for="days" class="form-label"><b>
                    </b></label>
                <div class="form-check form-check-inline"></div>

            </div>
            <div class="mb-3 skeleton-loading">
                <label class="form-label"></label><br>

                <div class="form-check form-check-inline">

                    <label class="form-check-label" for="wfh"></label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="onsite"></label>
                </div>
            </div>
        </div>
    </div>
</template>


<style scoped>
.skeleton-profile-image {
    justify-content: center;
    width: 100%;
    height: 100px;
    border-radius: 50%;
    background-color: #E0E0E0;
    animation: loading 1.9s ease-in-out infinite;
}

.bg-secondary.placeholder {
    background-color: #ddd;
}

.skeleton-loading {
    background-color: #f7f7f7;
    /* Light grey background */
    background-image: linear-gradient(to right, #f7f7f7 0%, #e8e8e8 20%, #f7f7f7 40%, #f7f7f7 100%);
    animation: skeleton-loading 2.0s ease-in-out infinite;
}

.skeleton-social1 {
    /* width: 200px; */
    height: 40px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-social2 {
    /* width: 200px; */
    height: 40px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-social3 {
    /* width: 200px; */
    height: 40px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-description {
    /* width: 200px; */
    height: 100px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-fname {
    /* width: 200px; */
    height: 40px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-lname {
    /* width: 200px; */
    height: 40px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-email {
    /* width: 200px; */
    height: 40px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-password {
    /* width: 200px; */
    height: 40px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

@keyframes skeleton-loading {
    0% {
        background-position: -200px 0;
    }

    100% {
        background-position: 200px 0;
    }
}

@keyframes loading {
    0% {
        opacity: 0.2;
    }

    20% {
        opacity: 0.4;
    }

    40% {
        opacity: 0.6;
    }

    60% {
        opacity: 0.8;
    }

    80% {
        opacity: 0.4;
    }

    100% {
        opacity: 0.2;
    }
}
</style>