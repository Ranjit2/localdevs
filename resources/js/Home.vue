<template>
    <div class="row">
        <div>
            <!-- <h3 class="text-center">Find your ideal talent quickly</h3> -->
        </div>
        <div class="col-md-3 mt-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!--  filters -->
                    <span class="filter-header" style="">Talent</span>

                    <div class="form-check " v-for="item in talents">
                        <template v-if="item.name === 'clear'">
                            <a href="#" @click.prevent="resetTalent()">Reset</a>
                        </template>
                        <template v-else>
                            <input class="form-check-input" type="radio" :value="item.id" :id="item.id"
                                v-model="filters.dev" @change="getUsers" />
                            <label class="form-check-label" :for=item.id> {{ item.name }}</label>
                        </template>
                    </div>

                    <span class="filter-header" style="background-color: ;color:;">Skills:</span>
                    <input type="text" class="form-control" placeholder="Search skills" style="border:1px solid #ccc"
                        @click="showOptionSkills = true">
                    <div class="card mt-1 shadow-sm" v-show="showOptionSkills" style="border: 1px solid #ccc;">
                        <div class="card-body" style="max-height:150px;overflow-y:scroll">
                            <div v-for="item in skillSet">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" :id="item.id" :value="item.id"
                                        v-model="filters.skill" @change="getUsers">
                                    <label class="form-check-label" :for="item.id">{{ item.name }}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <span class="filter-header" style="background-color: ;color:;">Work preference:</span>

                    <div class="form-check-inline" v-for="item in wpreference">
                        <input class="form-check-input" type="checkbox" :value="item.id" :id="item.id"
                            v-model="filters.preference" @change="getUsers" />
                        <label class="form-check-label pr-5" :for=item.id> {{ item.name }}</label>
                    </div>

                    <div v-if="filters.preference.includes('onsite')">
                        <span class="filter-header" style="background-color: ;color:;">Place:</span>

                        <input type="text" class="form-control" placeholder="Search places" style="border:1px solid #ccc"
                            @click="showOptionPlaces = true">
                        <div class="card mt-1 shadow-sm" v-show="showOptionPlaces" style="border: 1px solid #ccc;">
                            <div class="card-body" style="max-height:150px;overflow-y:scroll">
                                <div v-for="item in places">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :value="item.id" :id="item.id"
                                            v-model="filters.place" @change="getUsers" />
                                        <label class="form-check-label" :for="item.id"> {{ item.name }} </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <span class="filter-header" style="background-color: ;color:;">Experience:</span>

                    <div class="form-check" v-for="item in experience">
                        <template v-if="item.name === 'clear'">
                            <a href="#" @click.prevent="resetExperience()">Reset</a>
                        </template>
                        <template v-else>
                            <input class="form-check-input" type="radio" :value="item.exp" :id="item.id"
                                v-model="filters.experience" @change="getUsers" />
                            <label class="form-check-label pr-5" :for=item.id> {{ item.name }}</label>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 mt-5">
            <div v-if="loading">
                <HomeLoading />
                <!-- Loading... -->
            </div>
            <p v-if="users.length < 1">
                No users for this skill set found.
            </p>

            <div v-if="!loading" class="card mb-3 shadow-lg" v-for="user in users"
                style="border: 1px solid #ccc;border-radius: 5px;">
                <a style="cursor:pointer" data-bs-toggle="offcanvas" :data-bs-target="'#offcanvasUser' + user.id">
                    <div class="card-body shadow-sm">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="profile-picture">
                                    <img src="https://profile-image-uploader.s3.amazonaws.com/images/WBqGBdWBoTnSZhRLjuOSMsKBODQErTzXu8vxZaVD.png"
                                        alt="Profile picture" class="rounded-circle">
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <h4 class="color: navy">{{ user.firstname }}&nbsp;{{ user.lastname }}</h4>
                                <h5>{{ user.expertise }},&nbsp;<span style="color: #4a4a4a; font-size:medium;">{{
                                    user.experience }} years experience</span></h5>
                                <p style="justify-content: center;">Lorem ipsum dolor sit amet, conskectetur adipiscing
                                    elit. Duis vel risus commodo, faucibus
                                    ipsum nec, bibendum justo. Nullam mattis orci vel quam imperdiet bibendum.</p>
                                <div class="tags">
                                    <span v-for="(skill, index) in user.skills" :key="index"
                                        class="badge badge-pill badge-primary"
                                        style="background-color: rgb(241 245 249) ; color: #222; font-size: small; padding: 5px; margin-right: 5px;">
                                        {{ skill.name }}
                                    </span>
                                </div>

                                <div class="mt-3">
                                    <i class='fas fa-map-marker-alt'
                                        style='font-size:larger ;color:grey'></i>&nbsp;Kathmandu &nbsp;&nbsp;
                                    <i class='far fa-calendar-alt' style='font-size:larger;color:grey'></i> Mon, Tue, Wed
                                </div>
                                <p class="mt-3">{{ user.workPreference }}</p>
                            </div>

                            <!-- <div class="col-md-3">
                                <p class="" style="font-size:medium ;">Why consider me?</p>
                                <ul>
                                    <li> Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                                    <li> Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                                    <li> Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </a>
                <div class="card-footer">
                    <hr class="hr">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <a data-bs-toggle="offcanvas" :data-bs-target="'#offcanvasUser' + user.id">
                                <i class="fas fa-user fa-lg" style="color: navy; cursor: pointer;"></i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="icon-link" title="Chat">
                                <i class="fas fa-comments fa-lg" style="color: navy;"></i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="dropdown">
                                <a href="#" class="icon-link dropdown-toggle" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" title="Options">
                                    <i class="fas fa-ellipsis-h fa-lg" style="color: navy;"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Item 1</a>
                                    <a class="dropdown-item" href="#">Item 2</a>
                                    <a class="dropdown-item" href="#">Item 3</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--slide over-->
                <div class="offcanvas offcanvas-end" tabindex="-1" :id="'offcanvasUser' + user.id"
                    aria-labelledby="offcanvasUserLabel" style="width: 50%; max-width: none;">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasUserLabel">{{ user.firstname }}&nbsp;{{ user.lastname }}
                        </h5>
                        <span class="float-right"><a :href="'/talent/' + user.slug">View in single page</a></span>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <!-- Panel content goes here -->
                        <p>{{ user.about }}</p>
                        <p>
                        <h5 class="offcanvas-title">Experience</h5>
                        {{ user.experience }} years
                        </p>
                        <p>
                        <h5 class="offcanvas-title">My top skills</h5>
                        <div class="tags">
                            <span v-for="(skill, index) in user.skills" :key="index" class="btn btn-primary"
                                style="padding: 5px; margin-right: 5px;">
                                {{ skill.name }}
                            </span>
                        </div>
                        </p>
                        <p>
                        <h5 class="offcanvas-title">Work preference</h5>
                        {{ user.workPreference }}
                        </p>
                        <p>
                        <h5 class="offcanvas-title">Avability</h5>
                        {{ user.availableDays }} ({{ user.availableHours }} hours a week)
                        </p>
                        <p>
                        <h5 class="offcanvas-title">Prefer worktype</h5>
                        {{ user.workType }}
                        </p>
                        <p>
                            <button class="btn btn-info text-white">Chat now</button>
                        </p>
                    </div>
                </div>
            </div>

            <div v-if="pagination.last_page > 1">
                <button class="btn btn-primary" style="background-color: navy;" @click="previousPage"
                    :disabled="pagination.current_page == 1">Previous</button>&nbsp;
                <button class="btn btn-primary" @click="nextPage" :disabled="pagination.next_page_url == null"
                    style="background-color: navy;">Next</button>
                <!-- <div v-else class="spinner"></div> -->
            </div>
        </div>
    </div>
    <button @click="resetFilters" class="btn btn-danger">Reset filter</button>
</template>
<script>
import HomeLoading from './components/HomeLoading.vue';

export default {
    data() {
        return {
            initialPageMounted: true,
            loading: false,
            showOptionSkills: false,
            showOptionPlaces: false,
            skillSet: [],
            wpreference: [
                {
                    id: "onsite",
                    name: "Onsite",
                },
                {
                    id: "wfh",
                    name: "Remote",
                },

            ],
            //radio
            talents: [
                {
                    id: "frontend",
                    name: "Designer",
                },

                {
                    id: "backend",
                    name: "Developer",
                },
                {
                    id: "motion",
                    name: "Motion",
                },
                {
                    id: "pm",
                    name: "Project Manager",
                },
                {
                    id: "",
                    name: "clear",
                },
            ],
            //checkbox
            places: [
                {
                    id: 1,
                    name: "Jhapa",
                },
                {
                    id: 2,
                    name: "Morang",
                },
                {
                    id: 3,
                    name: "Kathmandu",
                },
                {
                    id: 4,
                    name: "Bhaktapur",
                },
            ],
            //checkbox
            experience: [
                {
                    id: 1,
                    exp: "1-3",
                    name: "1 to 3 years",
                },
                {
                    id: 2,
                    exp: "3-6",
                    name: "3 to 6 years",
                },
                {
                    id: 3,
                    exp: "6-20",
                    name: "More than 6 years",
                },
                {
                    id: 4,
                    exp: "",
                    name: "clear",
                },
            ],
            users: [],
            filters: JSON.parse(localStorage.getItem("filters")) || {
                dev: "",
                preference: [],
                experience: [],
                place: [],
                skill: []
            },
            pagination: JSON.parse(localStorage.getItem("pagination")) || {},
        };
    },
    mounted() {
        this.getUsers();
        this.skillLists();
    },
    components: {
        HomeLoading
    },
    methods: {
        skillLists() {
            axios.get("/skills").then((response) => {
                this.skillSet = response.data;
            });
        },

        getUsers() {
            this.loading = true;
            axios
                .get("/filter/talents", { params: { filters: this.filters, page: this.pagination.current_page || 1 } })
                .then(response => {
                    this.users = response.data.data;
                    this.pagination = response.data;
                    localStorage.setItem("filters", JSON.stringify(this.filters));
                    localStorage.setItem("pagination", JSON.stringify(this.pagination));
                    if (!this.initialPageMounted) {
                        history.pushState(
                            {},
                            null,
                            `?page=${this.pagination.current_page}&dev=${this.filters.dev}&preference=${this.filters.preference
                            }&experience=${this.filters.experience}&place=${this.filters.place}&skill=${this.filters.skill}`
                        );
                    } else {
                        this.initialPageMounted = false;
                    }
                    this.loading = false;
                });

            // reset places if user unselect onsite
            if (!this.filters.preference.includes('onsite')) {
                this.filters.place = []
            }
        },
        resetFilters() {
            this.filters = { dev: '', place: [], preference: [], experience: [], skill: [] };
            this.pagination = { page: 1 }
            this.getUsers();
        },
        resetTalent() {
            this.filters.dev = ''
            this.getUsers();
        },
        resetExperience() {
            this.filters.experience = ''
            this.getUsers();
        },
        nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                this.getUsers();
            }
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        },
        previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                this.getUsers();
            }
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    }
};
</script>
<!-- <style>
.spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #ddd;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

</style> -->

<style >
body {
    font-family: 'Open Sans', sans-serif;
}

.clearTxt {
    display: none;
}

.card {
    border: none;
}

.profile-picture {
    display: flex;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.profile-picture img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 3px solid #4a4a4a;
}

h3 {
    margin-bottom: 0;
}

h5 {
    margin-top: 0.5rem;
    color: #6c757d;
}

p {
    margin-bottom: 1rem;
}

.tags {
    margin-top: 1rem;
}

.card-footer {
    background-color: #fff;
    border-top: none;
}

.hr {
    border: none;
    border-top: 1px solid #dee2e6;
    margin: 1rem 0;
}

.icon-link {
    display: block;
    margin: 0.5rem;
    transition: transform 0.3s ease;
}

.icon-link:hover {
    transform: scale(1.2);
}

.form-check:hover {
    background-color: #f5f5f5;
}

.form-check-label:hover {
    background-color: #f5f5f5;
    cursor: pointer;
}

/* Style for checkbox and radio button */
/* input[type="checkbox"], */
input[type="radio"] {
    /* -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: inline-block; */
    width: 20px;
    height: 20px;
    margin-right: 5px;
    border-radius: 4px;
    outline: none;
    cursor: pointer;
}

input[type="checkbox"] {
    /* -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: inline-block; */
    width: 18px;
    height: 18px;
    margin-right: 5px;
    border-radius: 4px;
    outline: none;
    cursor: pointer;
}

/* input[type="checkbox"]:checked,
input[type="radio"]:checked {
    background-color: #08c3a8;
    border-color: #08c3a8;
} */

/* Style for label */
label {
    font-size: 16px;
}

/* Increase font size for filter items */
div [v-for] {
    font-size: 18px;
}

/* Add Bootstrap card header style to filter headings */
h3 {
    /* font-size: 20px; */
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    /* font-weight: bold; */
    margin-top: 2rem;
}

.card-header {
    /* background-color: #28a745; */
    color: white;
    font-size: 24px;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-weight: bold;
}

span.filter-header {
    display: inline-block;
    background-color: #f5f5f5;
    padding: 5px;
    border-radius: 5px;
    font-size: 18px;
    margin-bottom: 5px;
    width: 100%;
    margin-bottom: 10px;
    margin-top: 10px;
}
</style>
