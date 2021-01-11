// =========================================================
// * Vue Material Kit - v1.2.2
// =========================================================
//
// * Product Page: https://www.creative-tim.com/product/vue-material-kit
// * Copyright 2019 Creative Tim (https://www.creative-tim.com)
// * Licensed under MIT (https://github.com/creativetimofficial/vue-material-kit/blob/master/LICENSE.md)
//
// * Coded by Creative Tim
//
// =========================================================
//
// * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.


require('./bootstrap');

// window.Vue = require('vue');

import Vue from "vue";
import App from "./views/App.vue";
import router from "./router";

import MaterialKit from "./plugins/material-kit";

Vue.config.productionTip = false;

Vue.use(MaterialKit);

const NavbarStore = {
  showNavbar: false
};

Vue.mixin({
  data() {
    return {
      settings: [
        {
          name: 'general',
          settings: {
            status_slide: true,
            charts_slide: true,
          }
        },
        {
          name: 'charts',
          settings: {
            BTC_currency: 'EUR',
            chart: false,
            chart_type: 'price',
            chart_period: 'year',
          }
        },
      ],
      loading: false,
      NavbarStore
    };
  },
  methods: {
    getSettings(name){
      var res = {};
      var i = 0;
      while(res !== {} && i < this.settings.length ){
        if (this.settings[i].name === name){
          res = this.settings[i].settings;
        }
        i++;
      }
      return res;
    },
    initializeSettings(){
      this.loading = true;
      axios
        .post('/initializeSettings', {
          params: {
            settings: this.settings,
          }
        })
        .then(res => {
          this.loading = false;
        });
    },
    loadSettingsFromDB(){
      this.loading = true;
      axios
        .get('/loadSettings')
        .then(res => {
            this.settings = res.data;
            for (var settingsLine of this.settings) {
              settingsLine.settings = JSON.parse(settingsLine.settings);
            }
            this.loading = false;
        });
    },
  },
  computed: {
    generalSettings: function (){
      return this.getSettings('general');
    },

    chartsSettings: function (){
      return this.getSettings('charts');
    }
  },
});

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


// new Vue({
//   router,
//   render: h => h(App)
// }).$mount("#app");


const app = new Vue({
  el: '#app',
  components: { App },
  router
});
