require('./bootstrap');


window.Vue = require('vue');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */



Vue.component('table-sms',   require('./components/SmsTable.vue').default);
Vue.component('frame-sms',   require('./components/SmsFrame.vue').default);
Vue.component('compose-sms', require('./components/Compose.vue').default);
Vue.component('detail-sms',  require('./components/SmsDetail.vue').default);
Vue.component('pie-chart',  require('./components/PieChart.vue').default);



const app = new Vue({
    el: '#app',
});