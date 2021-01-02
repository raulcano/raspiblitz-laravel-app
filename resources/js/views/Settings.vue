<template>

  <nav-tabs-card no-label class="mb-0 ml-0 mr-0">
            <template slot="content">
              <md-tabs class="md-primary" md-alignment="left">
                <md-tab id="tab-home" md-label="General" md-icon="app_settings_alt">
                    <p class="text-muted text-left">
                    Select which elements will be shown in the main menu
                    </p><br>
                    <div v-for="value,key in generalSettings">
                      <md-switch v-model="generalSettings[key]" @change="upsertSettings('general',generalSettings)">Show {{key}} slide in carousel:  {{value}}</md-switch>
                      <br>
                    </div>
                    <md-progress-bar v-if="loading" md-mode="indeterminate"></md-progress-bar>
                </md-tab>

                <md-tab id="tab-pages" md-label="Status" md-icon="build">
                  <p class="text-muted text-left">
                    No options available
                    </p><br>
                </md-tab>


                <!-- <md-tab id="tab-posts" md-label="Charts" md-icon="timeline" v-if="generalSettings['charts_slide']"> -->
                <md-tab id="tab-posts" md-label="Charts" md-icon="timeline" >
                  <p class="text-muted text-left">
                    Select which elements will be shown in the main menu
                    </p><br>
                </md-tab>


              </md-tabs>
            </template>
          </nav-tabs-card>
</template>

<script>
import { NavTabsCard } from "../components";
export default {
  components: {
    NavTabsCard,
  },
  name: "settings",
  bodyClass: "index-page",
  props: {
  },
  data() {
    return {
      available_slides: ['general', 'charts'], // needed?
      settings: [],
      loading: false,
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
    upsertSettings(setting_name, settings_key_values){
      this.loading = true;
      axios
        .post('/upsertSettings', {
          params: {
            name: setting_name,
            settings: settings_key_values,
          }
        })
        .then(res => {
          this.loading = false;
        });
    },
  },

  mounted() {
        this.loadSettingsFromDB();
  },

  computed: {
    generalSettings: function (){
      return this.getSettings('general');
    }

  }
};
</script>
<style scoped>
</style>
