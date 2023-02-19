<template>
    <div class="row">
        <div class="col-md-4">
            <!-- Checkbox filters -->
            <h3>Talent:</h3>
            <div v-for="item in talents">
                <input type="radio" :value="item.id" v-model="filters.dev" @change="getUsers" />
                {{ item.name }}
            </div>

            <h3>Work Preference:</h3>
            <div v-for="item in wpreference">
                <input type="checkbox" :value="item.id" v-model="filters.preference" @change="getUsers" />
                {{ item.name }}
            </div>

            <h3>Skills:</h3>
            <div v-for="item in skillSet">
                <input type="checkbox" :value="item.id" v-model="filters.skill" @change="getUsers" />
                {{ item.name }}
            </div>

            <h3>Place:</h3>
            <div v-for="item in places">
                <input type="checkbox" :value="item.id" v-model="filters.place" @change="getUsers" />
                {{ item.name }}
            </div>


            <h3>Experience:</h3>
            <div v-for="item in experience">
                <input type="radio" :value="item.exp" v-model="filters.experience" @change="getUsers" />
                {{ item.name }}
            </div>
        </div>

        <div class="col-md-8">
            <div v-if="loading">
                Loading...<div class="spinner"></div>
            </div>
            <p v-if="users.length < 1">
                No users for this skill set found.
            </p>
            <div class="card mt-2" v-for="user in users">
                <div class="card-header d-flex align-items-center">
                    <div class="avatar-wrapper mr-3">
                        <div class="lazyload-wrapper">
                            <div class="cui-avatar-image mentor-avatar">
                                <img alt="Stefan Georg, Django engineer and developer" title="Stefan Georg" width="100"
                                    src="https://cdn.mentorcruise.com/cache/2130ff23a0944ccbaf462a36d793d42c/f4bb925524ce287f/342975b7377a6875aa85de0a13fa4733.jpg"
                                    class="img-fluid">
                                <h3>{{ user.firstname }}&nbsp;{{ user.lastname }}</h3>
                            </div>
                            <p v-for="(skill, index) in user.skills" :key="index" class="badge text-bg-primary p-2"
                                style="margin-left: 3px;;"> {{
                                    skill.
                                        name
                                }}</p>
                            <p class="font-medium text-success fs-5 mt-2">
                                15+ experience education sector, tech-business-product background,
                                early-to-late
                                stage
                                experience, hands-on
                            </p>
                        </div>
                    </div>
                    <div class="name-wrapper">

                        <a :href="'talent/' + user.slug"><button class="btn btn-primary">View Profile</button></a>

                    </div>
                </div>
            </div>
            <br>
            <div v-if="pagination.last_page > 1">
                <button class="btn btn-primary" @click="previousPage"
                    :disabled="pagination.current_page == 1">Previous</button>&nbsp;
                <button class="btn btn-primary" @click="nextPage"
                    :disabled="pagination.next_page_url == null">Next</button>
            </div>
        </div>
    </div>
    <button @click="resetFilters" class="btn btn-danger">Reset filter</button>
</template>
<script>

export default {
    data() {
        return {
            initialPageMounted: true,
            loading: false,
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
                    exp: "6",
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
                            }&experience=${this.filters.experience}&place=${this.filters.place}&skill=${this.filters.skill
                            }`
                        );
                    } else {
                        this.initialPageMounted = false;
                    }
                    this.loading = false;
                });
        },
        resetFilters() {
            this.filters = { dev: '', place: [], preference: [], experience: [], skill: [] };
            this.pagination = { page: 1 }
            this.getUsers();
        },
        nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                this.getUsers();
            }
        },
        previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                this.getUsers();
            }
        }
    }
};
</script>
<style>
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
</style>