require('./bootstrap');



import { createApp } from 'vue';

import $ from "jquery";
import { configure, defineRule } from "vee-validate";







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

import UserProfile from './components/client/profile/index.vue';

import CartList from './components/client/cart/index.vue';

import ResetPass from './components/auth/reset-password.vue';

import ContactForm from './components/client/contact/form-contact.vue';

import NewsCreate from './components/admin/new/create.vue';
import NewsEdit from './components/admin/new/edit.vue';

import SizeCreate from './components/admin/size/create.vue';
import SizeEdit from './components/admin/size/edit.vue';

import ColorCreate from './components/admin/color/create.vue';
import ColorEdit from './components/admin/color/edit.vue';

const app = createApp({});



app.component("size-create", SizeCreate);
app.component("size-edit", SizeEdit);

app.component("color-create", ColorCreate);
app.component("color-edit", ColorEdit);

app.component("category-create", CategoryCreate);
app.component("category-edit", CategoryEdit);

app.component("news-create", NewsCreate);
app.component("news-edit", NewsEdit);

app.component("user-create", UserCreate);
app.component("user-edit", UserEdit);

app.component("product-create", ProductCreate);
app.component("product-edit", ProductEdit);

app.component("stock-edit", StockEdit);

app.component("data-empty", DataEmpty);

app.component("login-form", LoginForm);
app.component("register-form", RegisterForm);

app.component("user-profile", UserProfile);

app.component("cart-list", CartList);

app.component("contact-form", ContactForm);

app.component("reset-pass", ResetPass);

app.mount("#app");