<template>
    <div>
        <div class="row col-md-3">
            <router-link to="/expense" class="btn btn-primary"
                >All Expenses</router-link
            >
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Add Expense
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="expenseInsert"
                                        enctype="multipart/form-data"
                                    >
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label
                                                        for="exampleFormControlTextarea1"
                                                        >Expense Amount</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputLastName"
                                                        placeholder="Enter expense amount"
                                                        v-model="form.amount"
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.amount"
                                                        >{{
                                                            errors.amount[0]
                                                        }}</small
                                                    >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label
                                                        for="exampleFormControlTextarea1"
                                                        >Expense Details</label
                                                    >
                                                    <textarea
                                                        class="form-control"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3"
                                                        v-model="form.details"
                                                    ></textarea>
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.details"
                                                        >{{
                                                            errors.details[0]
                                                        }}</small
                                                    >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block"
                                            >
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            form: {
                amount: "",
                details: "",
            },
            errors: {},
        };
    },

    methods: {
        expenseInsert() {
            axios
                .post("/api/expense", this.form)
                .then(() => {
                    this.$router.push({ name: "expense" });
                    Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
};
</script>

<style></style>
