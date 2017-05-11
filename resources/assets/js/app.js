
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('enrollment', require('./components/Enrollment.vue'));
// Vue.component('enrollments', require('./components/Enrollments.vue'));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component('dashboard-small-box', require('./components/dashboard/SmallBox.vue'))
Vue.component('dashboard-increase-button', require('./components/dashboard/IncreaseButton.vue'))
Vue.component('activity-feed', require('./components/dashboard/ActivityFeed.vue'))
Vue.component('chart', require('./components/dashboard/Chart.vue'))

import Vue2Filters from 'vue2-filters'

window.Vue.use(Vue2Filters)

import VueEcho from 'vue-echo'

Vue.use(VueEcho, {
    broadcaster: 'pusher',
    key: 'dda059974aeff833e6a6',
    cluster: 'eu',
    encrypted: true
});

const app = new Vue({
    el: '#app'
});
