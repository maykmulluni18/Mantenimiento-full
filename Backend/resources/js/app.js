import './bootstrap';
import '../sass/app.scss'
//theme
import "primevue/resources/themes/lara-light-indigo/theme.css";

//core
import "primevue/resources/primevue.min.css";

import Router from '@/router'
import store from '@/store'
import PrimeVue from 'primevue/config';


import { createApp } from 'vue/dist/vue.esm-bundler';

const app = createApp({})
app.use(Router)
app.use(store)
app.use(PrimeVue)
app.mount('#app')
