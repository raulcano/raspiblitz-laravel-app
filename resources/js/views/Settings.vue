<template>
<div>
  <div class="carousel-link" title="Back to main screen">
    <a href="#/carousel">
      <md-icon>home</md-icon>
     </a>
  </div>
  
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
            Configure the charts slide with the following options
            </p><br>

            <div class="md-layout md-gutter">
                  <div class="md-layout-item">
                    <md-field>
                      <label for="BTC_currency">Show BTC price in</label>
                        <md-select v-model="chartsSettings['BTC_currency']" name="BTC_currency" id="BTC_currency" @md-selected="upsertSettings('charts',chartsSettings)">
                          <md-option value="EUR">Euro</md-option>
                          <md-option value="USD">US Dollar</md-option>
                          <md-option value="GBP">British Pound</md-option>
                          <!-- <md-option value="CHF">Swiss Franc</md-option> -->
                        </md-select>
                      </md-field>
                  </div>
            </div>
            <br>
            <md-switch v-model="chartsSettings['chart']" @change="upsertSettings('charts',chartsSettings)">Show BTC chart</md-switch>
            <br>
            <div class="md-layout md-gutter">
                <div class="md-layout-item">
                    <md-radio v-model="chartsSettings['chart_type']" value="price" class="md-primary" 
                      @change="upsertSettings('charts',chartsSettings)"
                      :disabled="!chartsSettings['chart']">Price chart</md-radio>
                </div>
                <div class="md-layout-item">
                    <md-radio v-model="chartsSettings['chart_type']" value="hashrate" class="md-primary" 
                  @change="upsertSettings('charts',chartsSettings)"
                  :disabled="!chartsSettings['chart']">Hashrate chart</md-radio>
                </div>
                <div class="md-layout-item">
                  <md-field>
                      <label for="chart_period">Period</label>
                        <md-select v-model="chartsSettings['chart_period']" name="chart_period" id="chart_period" 
                        @md-selected="upsertSettings('charts',chartsSettings)"
                        :disabled="!chartsSettings['chart']">
                          <md-option value="day" :disabled="!chartsSettings['chart']">Day</md-option>
                          <md-option value="week" :disabled="!chartsSettings['chart']">Week</md-option>
                          <md-option value="month" :disabled="!chartsSettings['chart']">Month</md-option>
                          <md-option value="year" :disabled="!chartsSettings['chart']">Year</md-option>
                        </md-select>
                </md-field>
                </div>
            </div>
            <br>
            <md-progress-bar v-if="loading" md-mode="indeterminate"></md-progress-bar>
        </md-tab>


      </md-tabs>
    </template>
  </nav-tabs-card>
</div>
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
    };
  },
  methods: {
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
        this.initializeSettings();
        this.loadSettingsFromDB();
  },
};
</script>
<style>
.carousel-link{
  position: absolute;
  top: 20px;
  right: 30px;
  z-index: 100;
}
</style>
