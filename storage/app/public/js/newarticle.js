import siteheader from '../vue/siteheader.vue';
import newarticle from '../vue/newarticle.vue';
import {createApp} from 'vue/dist/vue.esm-bundler.js';

const app = createApp({});

app.component('siteheader',siteheader);
app.component('newarticle',newarticle);

app.mount("#testingID")