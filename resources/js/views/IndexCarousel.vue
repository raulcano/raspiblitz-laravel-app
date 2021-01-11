<template>
  <md-card class="mt-0 mb-0 ml-0 mr-0">
    <div class="settings-link" title="Settings">
    <a href="#/settings">
        <md-icon>settings</md-icon>
        </a>
    </div>
    

    <carousel
      :per-page="1"
      loop
      :speed="700"
      autoplay
      :autoplay-timeout="5000"
      :mouse-drag="true"
      navigationEnabled
      navigationNextLabel="<i class='material-icons'>keyboard_arrow_right</i>"
      navigationPrevLabel="<i class='material-icons'>keyboard_arrow_left</i>"
    >
    

      <slide v-if="generalSettings.status_slide">
        <div class="carousel-caption">
          <status-slide></status-slide>
        </div>
        <img :src="status" alt="Status" />
      </slide>
      

      <slide v-if="generalSettings.charts_slide">
        <div class="carousel-caption">
          <charts-slide></charts-slide>
        </div>
        <img :src="bitcoin" alt="bitcoin" />
      </slide>


    </carousel>
  </md-card>
</template>

<script>
import StatusSlide from './components/StatusSlide.vue';
import ChartsSlide from './components/ChartsSlide.vue';

export default {
  components: {
    StatusSlide, ChartsSlide
  },
  name: "index-carousel",
  bodyClass: "index-page",
  props: {
  },
  data() {
    return {
      bitcoin: require("../assets/img/bitcoin-background.webp"),
      status: require("../assets/img/raspiblitz-status.png")
    };
  },
  mounted() {
      this.initializeSettings();
      this.loadSettingsFromDB();
  },
  
};
</script>
<style lang="scss">
@media all and (min-width: 991px) {
  .btn-container {
    display: flex;
  }
}

.settings-link{
  position: absolute;
  top: 20px;
  right: 30px;
  z-index: 100;
}
</style>
