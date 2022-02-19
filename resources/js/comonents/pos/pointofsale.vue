<template>
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Dashboard
                </li>
            </ol>
        </div>

        <div class="row mb-3">
            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
                <div class="card mb-4">
                    <div class="table-responsive" style="font-size: 14px">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cart in carts" :key="cart.id">
                                    <td>{{ cart.pro_name }}</td>
                                    <td>
                                        <input
                                            type="text"
                                            readonly
                                            :value="cart.pro_qty"
                                            style="width: 1.5rem"
                                        />
                                        <button
                                            class="btn btn-sm btn-success"
                                            @click.prevent="increment(cart.id)"
                                        >
                                            +
                                        </button>
                                        <button
                                            class="btn btn-sm btn-danger"
                                            @click.prevent="decrement(cart.id)"
                                            v-if="cart.pro_qty >= 2"
                                        >
                                            -
                                        </button>
                                        <button
                                            class="btn btn-sm btn-danger"
                                            v-else=""
                                            disabled
                                        >
                                            -
                                        </button>
                                    </td>
                                    <td>{{ cart.product_price }}</td>
                                    <td>{{ cart.sub_total }}</td>
                                    <td>
                                        <a
                                            @click="removeItem(cart.id)"
                                            class="btn btn-sm btn-primary text-white"
                                            >X</a
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <ul class="list-group">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                Quantity :
                                <strong>{{ qty }}</strong>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                Sub Total :
                                <strong>$ {{ subTotal }}</strong>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                Vat :
                                <strong>$ {{ vats.vat }}</strong>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                Total :
                                <strong
                                    >$
                                    {{
                                        (subTotal * vats.vat) / 100 + subTotal
                                    }}</strong
                                >
                            </li>
                        </ul>
                        <br />
                        <form action="">
                            <label for="cutomers">Customer Name</label>
                            <select
                                id="cutomers"
                                class="form-control mb-2"
                                v-model="customer_id"
                            >
                                <option
                                    value="customer.name"
                                    v-for="customer in customers.data"
                                    :key="customer.id"
                                >
                                    {{ customer.name }}
                                </option>
                            </select>

                            <label for="pay">Pay</label>
                            <input
                                type="text"
                                id="pay"
                                class="form-control"
                                required
                                v-model="pay"
                            />
                            <label for="pay">Due</label>
                            <input
                                type="text"
                                id="due"
                                class="form-control"
                                required
                                v-model="due"
                            />

                            <label for="payby">Pay By</label>
                            <select
                                id="payby"
                                class="form-control"
                                v-model="payby"
                            >
                                <option value="cash">Hand Cash</option>
                                <option value="creditdebit">
                                    Credit Card/ Debit Card
                                </option>
                                <option value="Cheaque">Online Payment</option>
                                <option value="GiftCard">GiftCard</option>
                                <option value="Other">Other</option>
                            </select>
                            <br />
                            <button type="submit" class="btn btn-success">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-7 col-lg-7">
                <div class="card mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Products Sold
                        </h6>
                    </div>

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button
                                class="nav-link active"
                                id="nav-home-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#nav-home"
                                type="button"
                                role="tab"
                                aria-controls="nav-home"
                                aria-selected="true"
                            >
                                All Products
                            </button>
                            <button
                                class="nav-link"
                                id="nav-profile-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#nav-profile"
                                type="button"
                                role="tab"
                                aria-controls="nav-profile"
                                aria-selected="false"
                                v-for="category in categories.data"
                                :key="category.id"
                                @click="getProductByID(category.id)"
                            >
                                {{ category.category_name }}
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div
                            class="tab-pane fade show active"
                            id="nav-home"
                            role="tabpanel"
                            aria-labelledby="nav-home-tab"
                            @click="getProductByID(product.id)"
                        >
                            <div class="card-body">
                                <div class="row m-3">
                                    <form @submit.prevent="getResults">
                                        <input
                                            type="text"
                                            v-model="search"
                                            placeholder="Search Here"
                                            class="form-control mb-5"
                                            style="width: 300px"
                                        />
                                    </form>

                                    <div
                                        class="col-lg-3 col-md-3 col-sm-5 col-6"
                                        v-for="product in products.data"
                                        :key="product.id"
                                    >
                                        <button
                                            class="btn btn-sm"
                                            @click.prevent="
                                                AddToCart(product.id)
                                            "
                                        >
                                            <div
                                                class="card"
                                                style="width: 8.5rem"
                                            >
                                                <img
                                                    class="card-img-top"
                                                    :src="product.image"
                                                    id="em_photo"
                                                    alt="Card image cap"
                                                />
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        {{
                                                            product.product_name
                                                        }}
                                                    </h6>
                                                    <span
                                                        class="badge badge-success"
                                                        v-if="
                                                            product.product_qty >=
                                                            1
                                                        "
                                                        >Available :
                                                        {{
                                                            product.product_qty
                                                        }}</span
                                                    >
                                                    <span
                                                        class="badge badge-danger text-center"
                                                        v-else
                                                    >
                                                        Stock out
                                                    </span>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="nav-profile"
                            role="tabpanel"
                            aria-labelledby="nav-profile-tab"
                        >
                            <div class="card-body">
                                <div class="row m-3">
                                    <form @submit.prevent="getResults">
                                        <input
                                            type="text"
                                            v-model="search"
                                            placeholder="Search Here"
                                            class="form-control mb-5"
                                            style="width: 300px"
                                        />
                                    </form>

                                    <div
                                        class="col-lg-3 col-md-3 col-sm-5 col-6"
                                        v-for="product in getProducts.data"
                                        :key="product.id"
                                    >
                                        <button
                                            class="btn btn-sm"
                                            @click.prevent="
                                                AddToCart(product.id)
                                            "
                                        >
                                            <div
                                                class="card"
                                                style="width: 8.5rem"
                                            >
                                                <img
                                                    class="card-img-top"
                                                    :src="product.image"
                                                    id="em_photo"
                                                    alt="Card image cap"
                                                />
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        {{
                                                            product.product_name
                                                        }}
                                                    </h6>
                                                    <span
                                                        class="badge badge-success"
                                                        v-if="
                                                            product.product_qty >=
                                                            1
                                                        "
                                                        >Available :
                                                        {{
                                                            product.product_qty
                                                        }}</span
                                                    >
                                                    <span
                                                        class="badge badge-danger text-center"
                                                        v-else
                                                    >
                                                        Stock out
                                                    </span>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <pagination
            :data="getProducts"
            @pagination-change-page="getResults"
        ></pagination>
        <!--Row-->
    </div>
    <!---Container Fluid-->
</template>

<script>
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
    },

    mounted() {
        // Fetch initial results
        this.getResults();
    },

    data() {
        return {
            products: {},
            categories: {},
            getProducts: {},
            // data:{},
            search: "",
            customers: {},
            carts: "",
            vats: "",
        };
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
                    console.log(response.data);
                });
        },

        allProduct() {
            axios
                .get("/api/product")
                .then((response) => {
                    this.products = response.data;
                    // this.productsSearch = response;
                    //  console.log(this.employees)
                    //   // this.data=response.data
                })
                .catch((error) => console.log(error));
        },
        allCategories() {
            axios
                .get("/api/category")
                .then((response) => {
                    this.categories = response.data;
                    // this.productsSearch = response;
                    //  console.log(this.employees)
                    //   // this.data=response.data
                })
                .catch((error) => console.log(error));
        },
        allCustomers() {
            axios
                .get("/api/customer")
                .then((response) => {
                    this.customers = response.data;
                    // this.productsSearch = response;
                    //  console.log(this.employees)
                    //   // this.data=response.data
                })
                .catch((error) => console.log(error));
        },
        getProductByID(id) {
            axios
                .get("/api/get/product/" + id)
                .then((response) => {
                    this.getProducts = response.data;
                    console.log(response.data);
                })
                .catch((error) => console.log(error));
        },
        // CartMethods
        AddToCart(id) {
            axios
                .get("/api/addtoCart/" + id)
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Notification.cart_success();
                })
                .catch((error) => console.log(error));
        },
        CartProduct() {
            axios
                .get("/api/cart/product/")
                .then((response) => {
                    this.carts = response.data;
                    console.log(response.data);
                })
                .catch((error) => console.log(error));
        },
        removeItem(id) {
            axios
                .get("/api/remove/cart/" + id)
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Notification.cart_danger();
                })
                .catch((error) => console.log(error));
        },

        increment(id) {
            axios
                .get("/api/increment/" + id)
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Notification.success();
                })
                .catch((error) => console.log(error));
        },
        decrement(id) {
            axios
                .get("/api/decrement/" + id)
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Notification.success();
                })
                .catch((error) => console.log(error));
        },
        vat() {
            axios
                .get("/api/vats/")
                .then((response) => {
                    this.vats = response.data;
                    console.log(response.data);
                })
                .catch((error) => console.log(error));
        },
    },
    computed: {
        qty() {
            let sum = 0;
            for (let i = 0; i < this.carts.length; i++) {
                sum += parseFloat(this.carts[i].pro_qty);
            }
            return sum;
        },
        subTotal() {
            let sum = 0;
            for (let i = 0; i < this.carts.length; i++) {
                sum +=
                    parseFloat(this.carts[i].pro_qty) *
                    parseFloat(this.carts[i].product_price);
            }
            return sum;
        },

        // filterSearch(){
        //     return this.employees.data.filter(employee =>{
        //     return employee.name.match(this.searchTerm)
        //   })
        // },
    },

    created() {
        this.allProduct();
        this.allCategories();
        this.allCustomers();
        this.CartProduct();
        this.vat();
        Reload.$on("AfterAdd", () => {
            this.CartProduct();
        });
    },
};
</script>

<style lang="scss" scoped>
#em_photo {
    height: auto;
    width: 100%;
}
</style>
