<template>

<div class="col-md-12 ">
    <div class="card mt-5">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="skeleton-profile-image"></div>
                </div>
                <div class="col-md-10">
                    <div class="skeleton-name"></div>
                    <div class="skeleton-location"></div>
                    <div class="skeleton-description"></div>
                    <div class="skeleton-expertise"></div>
                    <div class="skeleton-skills"></div>
                    <div class="skeleton-days-available"></div>
                    <div class="skeleton-work-type"></div>
                    <div class="skeleton-work-preference"></div>
                    <div class="skeleton-experience"></div>
                    <div class="skeleton-role-level"></div>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<style scoped>
/* Skeleton Styles */
.skeleton-profile-image {
    width: 100%;
    height: 100px;
    border-radius: 50%;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-name {
    width: 200px;
    height: 30px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-location {
    width: 150px;
    height: 20px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-description {
    width: 100%;
    height: 100px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-expertise {
    width: 100px;
    height: 20px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-skills {
    width: 200px;
    height: 30px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-days-available {
    display: flex;
    flex-wrap: wrap;
    margin-top: 10px;
}

.skeleton-days-available div {
    width: 30px;
    height: 30px;
    margin-right: 5px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-work-type {
    width: 80px;
    height: 30px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-work-preference {
    width: 80px;
    height: 30px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-experience {
    width: 60px;
    height: 20px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
}

.skeleton-role-level {
    width: 120px;
    height: 20px;
    margin-top: 10px;
    background-color: #E0E0E0;
    animation: loading 1.5s ease-in-out infinite;
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


