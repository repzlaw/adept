require('./bootstrap');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import Toasted from 'vue-toasted';
import { InertiaProgress } from '@inertiajs/progress'
import VueSwal from 'vue-swal'


Vue.use(Toasted)
Vue.use(VueSwal)

// Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);

Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

window.eventBus = new Vue();

InertiaProgress.init({
    color: '#29d',
    // Whether the NProgress spinner will be shown.
    showSpinner: true,
}); 



Vue.mixin({
    methods: {
        toaster(message, status) {
            Vue.toasted.show(message,{
                type : status,
                // icon : 'error_outline'
            }).goAway(2000);
        }, 
        
        
    },
});
const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
