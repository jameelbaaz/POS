<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="row col-md-3">
                <router-link to="/salary" class="btn btn-primary"
                    >Go Back</router-link
                >
            </div>
            <br />

            <form @submit.prevent="getResults">
                <input
                    type="text"
                    v-model="search"
                    placeholder="Search Here"
                    class="form-control"
                    style="width: 300px"
                />
            </form>

            <div class="row">
                <div class="col-lg-12 mb-4 mt-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                        >
                            <h6 class="m-0 font-weight-bold text-primary">
                                Employee Salary Details
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Month</th>
                                        <th>amount</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="salary in salaries.data"
                                        :key="salary.id"
                                    >
                                        <td>{{ salary.name }}</td>
                                        <td>{{ salary.salary_month }}</td>
                                        <td>{{ salary.amount }}</td>
                                        <td>{{ salary.salary_date }}</td>

                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'edit-salary',
                                                    params: { id: salary.id },
                                                }"
                                                class="btn btn-sm btn-primary text-white"
                                                >Edit Salary</router-link
                                            >
                                        </td>
                                    </tr>
                                    <pagination
                                        :data="salaries"
                                        @pagination-change-page="getResults"
                                    ></pagination>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
            <!--Row-->
        </div>
    </div>
</template>

<script>
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
    },

    data() {
        return {
            salaries: {},
            // data:{},
            search: "",
        };
    },
    mounted() {
        // Fetch initial results
        this.getResults();
    },
    methods: {
        // searchEmp(){
        //   axios.get('api/employee?search='+this.search)
        //   .then(response=>this.employees=response.data)
        // },

        //   // Our method to GET results from a Laravel endpoint
        getResults(page = 1) {
            axios.get("/api/salary?page=" + page);
            axios
                .get(`/api/salary?page=${page}&search=${this.search}`)
                .then((response) => {
                    this.salaries = response;
                    console.log(response);
                });
        },

        viewSalary() {
            let id = this.$route.params.id;
            axios
                .get("/api/salary/view/" + id)
                .then((response) => (this.salaries = response.data))
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
    computed: {
        // filterSearch(){
        //     return this.employees.data.filter(employee =>{
        //     return employee.name.match(this.searchTerm)
        //   })
        // },
    },

    created() {
        this.viewSalary();
    },
};
</script>

<style>
.em_photo {
    height: 40px;
    width: 40px;
}
</style>
