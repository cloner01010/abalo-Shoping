import sitebody from '../vue/sitebody.vue';
import siteheader from '../vue/siteheader.vue';
import ShoppingCartPopup from '../vue/shopping-cart.vue';
import {createApp} from 'vue/dist/vue.esm-bundler.js';
import Echo from "laravel-echo";
import pusher from 'pusher-js'
window.Pusher = pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'local',
    wsHost:'127.0.0.1',
    wsPort: 6001,
    cluster: "mt1",
    forceTLS: false,
    disableStats: true,
    authEndpoint :'http://127.0.0.1:8000/api/broadcasting/auth',
    auth:{
        headers: {
            Authorization: 'Bearer ',
        }
    },
});
const app = createApp({
});
app.component('sitebody', sitebody);
app.component('siteheader', siteheader);
app.component('shopping-cart-popup', ShoppingCartPopup);


app.mount("#app");

