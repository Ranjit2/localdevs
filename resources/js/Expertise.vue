<template>
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <div class="d-flex align-items-center">
                <h4 class="me-auto">Add your top expertise here</h4>
                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add-expertise" style="background-color: navy;">Add
                    Expertise</button>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="add-expertise" aria-labelledby="add-expertise-label">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="add-expertise-label">Add Expertise</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form>
                        <div class="mb-3">
                            <label for="expertise" class="form-label">Expertise</label>
                            <input type="text" class="form-control" v-model="search" @input="filterResults"
                                autocomplete="off" required>
                            <ul class="list-group" v-if="showResults">
                                <li class="list-group-item" v-for="result in filteredResults" :key="result"
                                    @click="selectResult(result)">{{ result }}</li>
                            </ul>
                        </div>
                        <div class="mb-3">
                            <label for="expertise" class="form-label">Years of experience</label>
                            <input type="number" class="form-control" id="expertise" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">What do you know about this technology</label>
                            <textarea class="form-control" cols="8" rows="10"
                                placeholder="Explain what do you know about this technology or how you have used this technology in your project." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: navy;">Save</button>
                    </form>
                </div>
            </div>



            <div class="card mt-2">
                <div class="card-body">
                    <h2>PHP</h2>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatum aperiam incidunt hic nemo ut magni
                    expedita, temporibus consequatur maxime repudiandae, sunt facere, cupiditate perspiciatis eaque natus
                    soluta! Delectus, in modi!
                </div>

            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <h2>Laravel</h2>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatum aperiam incidunt hic nemo ut magni
                    expedita, temporibus consequatur maxime repudiandae, sunt facere, cupiditate perspiciatis eaque natus
                    soluta! Delectus, in modi!
                </div>

            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <h2>Vuejs</h2>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatum aperiam incidunt hic nemo ut magni
                    expedita, temporibus consequatur maxime repudiandae, sunt facere, cupiditate perspiciatis eaque natus
                    soluta! Delectus, in modi!
                </div>

            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            search: '',
            results: ['php', 'css', 'javascript', 'html', 'python'],
            showResults: false
        }
    },
    computed: {
        filteredResults() {
            return this.results.filter(result => result.toLowerCase().includes(this.search.toLowerCase()))
        }
    },
    methods: {
        filterResults() {
            this.showResults = this.search.length > 0 //returns true or false
        },
        selectResult(result) {
            this.search = result
            this.showResults = false
        }
    }
}
</script>

<style scoped>
  .list-group-item:hover {
    background-color: #f2f2f2;
    cursor: pointer;
  }
</style>