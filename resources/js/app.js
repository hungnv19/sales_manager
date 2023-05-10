require('./bootstrap');



import { createApp } from 'vue';

import $ from "jquery";
import { configure, defineRule } from "vee-validate";



// import DashBroad from './components/DashBroad.vue';



import LoginForm from './components/auth/login/index.vue';
import RegisterForm from './components/auth/register/index.vue';

import ProductCreate from './components/admin/product/create.vue';
import ProductEdit from './components/admin/product/edit.vue';

import CategoryCreate from './components/admin/category/create.vue';
import CategoryEdit from './components/admin/category/edit.vue';

import UserCreate from './components/admin/user/create.vue';
import UserEdit from './components/admin/user/edit.vue';

import StockEdit from './components/admin/stock/edit.vue';

import DataEmpty from './components/common/dataEmpty.vue';



const app = createApp({});

// app.component("dash-broad", DashBroad);

app.component("category-create", CategoryCreate);
app.component("category-edit", CategoryEdit);   

app.component("user-create", UserCreate);
app.component("user-edit", UserEdit);

app.component("product-create", ProductCreate);
app.component("product-edit", ProductEdit);

app.component("stock-edit", StockEdit);

app.component("data-empty", DataEmpty);

app.component("login-form", LoginForm);
app.component("register-form", RegisterForm);



app.mount("#app");