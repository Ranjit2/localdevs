<template>
    <div class="card">
        <section class="filter-group">
            <header class="card-header">
                <h6 class="title">Talent</h6>
            </header>
            <div class="filter-content collapse show" id="collapse_1" style="">
                <div class="card-body ">
                    <select class="form-control" @onchange="filter.dev">
                        <option value="">Developer</option>
                        <option :value="talent.id" v-for="(talent, index) in talents" :key="index">{{ talent.name }}
                        </option>
                    </select>

                    <div class="grid grid-cols-2 gap-1">
                        <div v-for="(talent, index) in talents" :key="index">
                            <input class="hidden group peer" type="radio" :id="talent.name" :class="
                                talent.name == 'clear' ? 'clearTxt' : ''
                            " v-model="filter.dev" :value="talent.id" />
                            <label :class="
                                talent.name != 'clear'
                                    ? ''
                                    : ''
                            " :for="talent.name">
                                <span v-if="talent.name == 'clear'" style="cursor: pointer">
                                    <p class="" v-if="this.$route.query.dev">
                                        Reset talent
                                    </p>
                                </span>
                                <span v-else class="grid grid-cols-1 gap-1"> {{ talent.name }} </span>
                            </label>
                        </div>
                    </div>


                </div> <!-- card-body.// -->
            </div>
        </section> <!-- filter-group  .// -->
        <section class="filter-group">
            <header class="card-header">
                <h6 class="title">Skills</h6>
            </header>
            <div class="filter-content collapse show" id="collapse_2" style="">
                <div class="card-body">
                    <input class="form-control" v-model="skill_search" @focus="showDiv = true" id="name" type="text" />

                    <ul class="list-group shadow-sm p-3 mb-5 bg-body rounded" v-if="showDiv"
                        style="max-height: 150px; overflow-y: scroll;">
                        <li class="list-group-item" v-for="(s, index) in findSkills" :key="index">
                            <input class="check-input" type="checkbox" v-model="filter.skill" :value="s.id"
                                :id="s.id" /><label :for="s.id" class="check-label">{{ s.name }}</label>
                        </li>
                    </ul>

                </div> <!-- card-body.// -->
            </div>
        </section> <!-- filter-group .// -->
        <section class="filter-group">
            <header class="card-header">
                <h6 class="title">Work preference</h6>
            </header>
            <div class="filter-content collapse show" id="collapse_3" style="">
                <div class="card-body">
                    <select class="form-control" v-model="filter.preference">
                        <option value="">............</option>
                        <option value="onsite">Onsite</option>
                        <option value="wfh">WFH(Work from)</option>
                    </select>
                </div><!-- card-body.// -->
                <div v-if="this.$route.query.preference == 'onsite'"
                    class="relative block p-1 border-2 border-gray-200 rounded-lg" for="name">
                    <span class="text-xs font-medium text-gray-500" for="name">
                        Search Districts
                    </span>
                    <input class="form-control" v-model="search" @focus="showDiv = true" id="name" type="text" />

                    <ul class="list-group shadow-sm p-3 mb-5 bg-body rounded"
                        v-if="this.$route.query.preference == 'onsite'" style="max-height: 150px; overflow-y: scroll;">
                        <li class="list-group-item" v-for="place in findPlaces" :key="place.id" style=''>
                            <input class="check-input" type="checkbox" v-model="filter.place" :value="place.id"
                                :id="place.name" /><label :for="place.name" class="check-label">{{ place.name }}</label>
                        </li>
                    </ul>
                </div>
            </div>
        </section> <!-- filter-group .// -->
        <section class="filter-group">
            <header class="card-header">
                <h6 class="title">Experience</h6>
            </header>
            <fieldset>
                <div class="px-5 py-6 space-y-2">
                    <div class="flex items-center" v-for="(exp, index) in experience" :key="index">
                        <input type="radio" :id="index" :class="exp.name == 'clear' ? 'clearTxt' : ''"
                            v-model="filter.experience" :value="exp.exp" class="w-6 h-6 border-gray-200" name="e" />

                        <label :for="index" class="ml-3 text-sm font-medium">
                            <span v-if="exp.name == 'clear'" style="cursor: pointer">
                                <p class="pt-5 text-xs text-gray-500 underline" v-if="this.$route.query.experience">
                                    Reset Experience
                                </p>
                            </span>

                            <span v-else> {{ exp.name }}</span>
                        </label>
                    </div>
                </div>
            </fieldset>
        </section> <!-- filter-group .// -->
        <section class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">More filter </h6>
                </a>
            </header>
            <div class="filter-content collapse in" id="collapse_5">
                <div class="card-body">
                    <label class="custom-control custom-radio">
                        <input type="radio" name="myfilter_radio" checked="" class="custom-control-input">
                        <div class="custom-control-label">Any condition</div>
                    </label>

                    <label class="custom-control custom-radio">
                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                        <div class="custom-control-label">Brand new </div>
                    </label>

                    <label class="custom-control custom-radio">
                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                        <div class="custom-control-label">Used items</div>
                    </label>

                    <label class="custom-control custom-radio">
                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                        <div class="custom-control-label">Very old</div>
                    </label>
                </div><!-- card-body.// -->
            </div>
        </section> <!-- filter-group .// -->
    </div> <!-- card.// -->
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            showDiv: false,
            skills: [],
            expectClear: false,
            workprefrences: [
                {
                    id: "onsite",
                    name: "Onsite",
                },
                {
                    id: "wfh",
                    name: "Remote",
                },
                {
                    id: "",
                    name: "clearprefrences",
                },
            ],
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
            search: "",
            skill_search: "",

            filter: {
                dev: this.$route.query.dev,
                preference: this.$route.query.preference,
                location: this.$route.query.location,
                place: [],
                skill: [],
                experience: this.$route.query.experience,
            },
        };
    },
    computed: {
        findPlaces() {
            return this.places.filter((p) => {
                return (
                    p.name.toLowerCase().indexOf(this.search.toLowerCase()) !=
                    -1
                );
            });
        },

        findSkills() {
            return this.skills.filter((p) => {
                return (
                    p.name
                        .toLowerCase()
                        .indexOf(this.skill_search.toLowerCase()) != -1
                );
            });
        },
    },

    mounted() {
        //  console.log(this.$route.query.course)
        if (this.$route.query.skill) {
            let arr = this.$route.query.skill;
            for (let i = 0; i < arr.length; i++) {
                console.log("item:", arr[i]);
                this.filter.skill.push(arr[i]);
            }
        }

        this.skillLists();
    },
    //https://stackoverflow.com/questions/56383717/how-to-replace-one-parameter-in-vuejs-router
    methods: {
        clearExperience() {
            // router.push({ query: { experience: 'private' } })
            router.push({ query: { experience: 1 } });
            //this.$router.go(0)
            // this.$router.dev = '',
            // this.dev=''
            // this.preference = ''
            // this.$router.replace({'name':'App'})

            // window.reload();
            // const { experience, ...query } = this.$route.query;
            // this.$router.replace({ query: query });
            // document.getElementById("Choose_Yes").checked = false;
        },

        skillLists() {
            axios.get("/skills").then((response) => {
                this.skills = response.data;
                console.log(response.data);
            });
        },
    },

    watch: {
        filter: {
            handler() {
                const query = this.filter;
                // if (this.$route.query.preference == "wfh") {
                //    // const { place, ...query } = this.$route.query;
                //     //this.$router.replace({ query: query });
                //     this.$router.replace({query: {'my_query': 1}});
                // }
                this.$router.push({
                    query: query,
                });
            },
            deep: true,
        },
    },
};
</script>

<style scoped>
.ddlCars {
    min-height: 10px;
    overflow-y: auto;
    overflow-x: hidden;
    position: absolute;
    width: 300px;
    display: contents;
}

.clearTxt {
    display: none;
}

.button {
    float: left;
    margin: 0 5px 0 0;
    min-width: 100px;
    min-height: 40px;
    position: relative;
    background: #ccc;
}

.button label,
.button input {
    display: block;
    /* position: absolute; */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

.button input[type="radio"] {
    opacity: 0.011;
    z-index: 100;
}

.button input[type="radio"]:checked+label {
    background: #20b8be;
    border-radius: 4px;
}

.button label {
    cursor: pointer;
    z-index: 90;
    line-height: 1.8em;
}

.check-input {
    top: 1.2rem;
    scale: 1.7;
    margin-right: 0.8rem;
}

.check-label {
    padding-top: 13px;
}
</style>