<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="row col-md-3">
                <router-link to="/store-product" class="btn btn-primary"
                    >Add Product</router-link
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
                                Stocks
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Buying Price</th>
                                        <th>Status</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="product in products.data"
                                        :key="product.id"
                                    >
                                        <td>{{ product.product_name }}</td>
                                        <td>{{ product.product_code }}</td>
                                        <td>{{ product.category_id }}</td>
                                        <td>
                                            <img
                                                :src="product.image"
                                                alt="product"
                                                class="em_photo"
                                            />
                                        </td>
                                        <td>{{ product.buying_price }}</td>
                                        <td v-if="product.product_qty >= 1">
                                            <span class="badge badge-success"
                                                >Available</span
                                            >
                                        </td>
                                        <td v-else>
                                            <span class="badge badge-danger">
                                                Stock out
                                            </span>
                                        </td>
                                        <td>{{ product.product_qty }}</td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'edit-stock',
                                                    params: { id: product.id },
                                                }"
                                                class="btn btn-sm btn-primary text-white"
                                                >Edit</router-link
                                            >
                                        </td>
                                    </tr>
                                    <pagination
                                        :data="products"
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
            products: {},
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
            axios.get("/api/product?page=" + page);
            axios
                .get(`/api/product?page=${page}&search=${this.search}`)
                .then((response) => {
                    this.products = response.data;
                    //console.log(response.data.data)
                });
        },

        allProduct() {
            axios
                .get("/api/product")
                .then((response) => {
                    this.products = response.data;
                    this.productsSearch = response;
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
        this.allProduct();
    },
};
</script>

<style>
.em_photo {
    height: 40px;
    width: 40px;
}
</style>
