<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="row col-md-3">
                <router-link to="/store-employee" class="btn btn-primary"
                    >Add Employee</router-link
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
                                Employees List
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Photo</th>
                                        <th>Salary</th>
                                        <th>Joining Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="employee in employees.data"
                                        :key="employee.id"
                                    >
                                        <td>{{ employee.name }}</td>
                                        <td>{{ employee.email }}</td>
                                        <td>{{ employee.phone }}</td>
                                        <td>
                                            <img
                                                :src="employee.photo"
                                                alt="employee"
                                                class="em_photo"
                                            />
                                        </td>
                                        <td>{{ employee.salary }}</td>
                                        <td>{{ employee.joining_date }}</td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'pay-salary',
                                                    params: { id: employee.id },
                                                }"
                                                class="btn btn-sm btn-primary text-white"
                                                >Pay Salary</router-link
                                            >
                                        </td>
                                    </tr>
                                    <pagination
                                        :data="employees"
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
            employees: {},
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
            axios.get("/api/employee?page=" + page);
            axios
                .get(`/api/employee?page=${page}&search=${this.search}`)
                .then((response) => {
                    this.employees = response.data;
                    //console.log(response.data.data)
                });
        },

        allEmployee() {
            axios
                .get("/api/employee")
                .then((response) => {
                    this.employees = response.data;
                    this.employeesSearch = response;
                    //  console.log(this.employees)
                    //   // this.data=response.data
                })
                .catch((error) => console.log(error));
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
        this.allEmployee();
    },
};
</script>

<style>
.em_photo {
    height: 40px;
    width: 40px;
}
</style>
