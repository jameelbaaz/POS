let Login = require("./comonents/auth/Login.vue").default;
let Register = require("./comonents/auth/Register.vue").default;
let Forget = require("./comonents/auth/Forget.vue").default;
let Home = require("./comonents/Home.vue").default;
let Logout = require("./comonents/auth/Logout.vue").default;

// Employee
let employee = require("./comonents/employee/Index.vue").default;
let Storeemployee = require("./comonents/employee/Create.vue").default;
let editemployee = require("./comonents/employee/editemployee.vue").default;

// Supplier
let supplier = require("./comonents/supplier/index.vue").default;
let Storesupplier = require("./comonents/supplier/create.vue").default;
let editsupplier = require("./comonents/supplier/edit.vue").default;

// category
let category = require("./comonents/category/index.vue").default;
let Storecategory = require("./comonents/category/create.vue").default;
let editcategory = require("./comonents/category/edit.vue").default;

// product
let product = require("./comonents/product/index.vue").default;
let Storeproduct = require("./comonents/product/create.vue").default;
let editproduct = require("./comonents/product/edit.vue").default;

// product
let Expense = require("./comonents/expense/expense.vue").default;
let StoreExpense = require("./comonents/expense/create.vue").default;
let editExpense = require("./comonents/expense/edit.vue").default;

// salary
let salary = require("./comonents/salary/all_employee.vue").default;
let paySalary = require("./comonents/salary/create.vue").default;
let allSalary = require("./comonents/salary/index.vue").default;
let viewSalary = require("./comonents/salary/view.vue").default;
let editSalary = require("./comonents/salary/edit.vue").default;
// stock
let stock = require("./comonents/product/stock.vue").default;
let editstock = require("./comonents/product/editStock.vue").default;
// Customer
let storeCustomer = require("./comonents/Customer/create.vue").default;
let customer = require("./comonents/Customer/index.vue").default;
let editcustomer = require("./comonents/Customer/edit.vue").default;

// POS
let pos = require("./comonents/pos/pointofsale.vue").default;

export const routes = [
    { path: "/", component: Login, name: "/" },
    { path: "/register", component: Register, name: "register" },
    { path: "/forget", component: Forget, name: "forget" },
    { path: "/home", component: Home, name: "home" },
    { path: "/logout", component: Logout, name: "logout" },
    // Employee Routes
    {
        path: "/store-employee",
        component: Storeemployee,
        name: "store-employee",
    },
    { path: "/employee", component: employee, name: "employee" },
    {
        path: "/edit-employee/:id",
        component: editemployee,
        name: "edit-employee",
    },
    // Supplier Routes
    {
        path: "/store-supplier",
        component: Storesupplier,
        name: "store-supplier",
    },
    { path: "/supplier", component: supplier, name: "supplier" },
    {
        path: "/edit-supplier/:id",
        component: editsupplier,
        name: "edit-supplier",
    },

    // Category Routes
    {
        path: "/store-category",
        component: Storecategory,
        name: "store-category",
    },
    { path: "/category", component: category, name: "category" },
    {
        path: "/edit-category/:id",
        component: editcategory,
        name: "edit-category",
    },

    // Product Routes
    { path: "/store-product", component: Storeproduct, name: "store-product" },
    { path: "/product", component: product, name: "product" },
    { path: "/edit-product/:id", component: editproduct, name: "edit-product" },

    // expense Routes
    { path: "/store-expense", component: StoreExpense, name: "store-expense" },
    { path: "/expense", component: Expense, name: "expense" },
    { path: "/edit-expense/:id", component: editExpense, name: "edit-expense" },

    // salary Routes
    { path: "/given-salary", component: salary, name: "given-salary" },
    { path: "/salary/paid/:id", component: paySalary, name: "pay-salary" },
    { path: "/salary", component: allSalary, name: "salary" },
    { path: "/view-salary/:id", component: viewSalary, name: "view-salary" },
    { path: "/edit-salary/:id", component: editSalary, name: "edit-salary" },
    // Stock
    { path: "/stock", component: stock, name: "stock" },
    { path: "/edit-stock/:id", component: editstock, name: "edit-stock" },
    // Customer
    {
        path: "/store-customer",
        component: storeCustomer,
        name: "store-customer",
    },
    { path: "/customer", component: customer, name: "customer" },
    {
        path: "/edit-customer/:id",
        component: editcustomer,
        name: "edit-customer",
    },

    // Pos Routes
    {
        path: "/pos",
        component: pos,
        name: "pos",
    },
];
