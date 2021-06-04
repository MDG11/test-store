require('./bootstrap');
window.Vue = require('vue').default;
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
const app = new Vue({
    export default {

        data() {
            return {
                // Our data object that holds the Laravel paginator data
                laravelData: {},
            }
        },
    
        mounted() {
            // Fetch initial results
            this.getResults();
        },
    
        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('example/results?page=' + page)
                    .then(response => {
                        this.laravelData = response.data;
                    });
            }
        }
    
    }
    
});
