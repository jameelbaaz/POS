<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="row col-md-3">
                <router-link to="/store-expense" class="btn btn-primary"
                    >Add Expense</router-link
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
                                Expenses List
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="expense in expenses.data"
                                        :key="expense.id"
                                    >
                                        <td>{{ expense.details }}</td>
                                        <td>{{ expense.amount }}</td>
                                        <td>{{ expense.expense_date }}</td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'edit-expense',
                                                    params: { id: expense.id },
                                                }"
                                                class="btn btn-sm btn-primary text-white"
                                                >Edit</router-link
                                            >
                                            <a
                                                @click="
                                                    deleteExpenses(expense.id)
                                                "
                                                class="btn btn-sm btn-danger text-white"
                                                >Delete</a
                                            >
                                        </td>
                                    </tr>
                                    <pagination
                                        :data="expenses"
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
            expenses: {},
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
            axios.get("/api/expense?page=" + page);
            axios
                .get(`/api/expense?page=${page}&search=${this.search}`)
                .then((response) => {
                    this.expenses = response.data;
                    //console.log(response.data.data)
                });
        },

        allExpenses() {
            axios
                .get("/api/expense")
                .then((response) => {
                    this.expenses = response.data;
                    //  console.log(this.employees)
                    //   // this.data=response.data
                })
                .catch((error) => console.log(error));
        },

        deleteExpenses(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete("/api/expense/" + id)
                        .then(() => {
                            this.expenses = this.expenses.filter((category) => {
                                return expense.id != id;
                            });
                        })
                        .catch(() => {
                            //   this.$router.push({name:'supplier'})
                            window.location.reload();
                        });
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                }
            });
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
        this.allExpenses();
    },
};
</script>

<style>
.em_photo {
    height: 40px;
    width: 40px;
}
</style>
