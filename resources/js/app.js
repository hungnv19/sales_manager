require('./bootstrap');

require('./bootstrap');

import { createApp } from 'vue';

import $ from "jquery";
import { configure, defineRule } from "vee-validate";



// import DashBroad from './components/DashBroad.vue';



import LoginForm from './components/auth/login/index.vue';
import RegisterForm from './components/auth/register/index.vue';



// import DataEmpty from './components/common/dataEmpty.vue';



const app = createApp({});

// app.component("dash-broad", DashBroad);



// app.component("data-empty", DataEmpty);

app.component("login-form", LoginForm);
app.component("register-form", RegisterForm);



app.mount("#app");