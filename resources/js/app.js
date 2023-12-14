
import './bootstrap'
import { createApp } from 'vue'
import app from './components/app.vue'
import router from './router'
import i18n from "./i18n";
import directives from './directives'
// import store
import store from './store'
// import config
import config from './config'

//import datepicker
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
//import select2
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
// import pagination
import VueAwesomePaginate from "vue-awesome-paginate";
import "vue-awesome-paginate/dist/style.css";
//import momentjs
import moment from 'moment-timezone'
moment.tz.setDefault('Asia/Tokyo')

import DefaultLayout from "./layouts/default.vue";
import LoginLayout from "./layouts/login.vue";


const myapp = createApp(app);
myapp.use(router)
.use(i18n)
.use(directives)
.use(store)
.use(config)
.use(moment)
.use(VueAwesomePaginate)
.component('default-layout', DefaultLayout)
.component('login-layout', LoginLayout)
.component('Datepicker', Datepicker)
.component("v-select", vSelect )
.mount("#app")