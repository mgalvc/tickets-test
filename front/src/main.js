import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify';
import VueResource from 'vue-resource';

import AsyncComputed from 'vue-async-computed'
Vue.use(AsyncComputed)

Vue.config.productionTip = false

Vue.use(VueResource);
Vue.http.options.root = 'http://localhost:8000';

if(store.getters.token) {
    console.log(`tem salvo ${store.getters.token}`);
    Vue.http.headers.common['Authorization'] = `Basic ${store.getters.token}`;
}

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
