<template>
  <!-- <div class="wrapper">
    <div class="md-layout">
        <div class="md-layout-item md-size-66 mx-auto md-small-size-100"> -->
          <md-card class="mt-0 mb-0 ml-0 mr-0">
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
              <slide>
                <div class="carousel-caption">
                  <h4>
                    <md-button class="md-success md-lg">
                      <md-icon>refresh</md-icon>
                      Refresh
                    </md-button>
                  </h4>
                </div>
                <img :src="status" alt="Status" />
              </slide>
              <slide>
                <div class="carousel-caption">
                  <h4>
                    <md-button class="md-success md-lg">
                      <md-icon>refresh</md-icon>
                      Refresh
                    </md-button>
                  </h4>
                </div>
                <img :src="bitcoin" alt="bitcoin" />
              </slide>
            </carousel>
          </md-card>
        <!-- </div>
      </div>

  </div> WRAPPER -->
</template>

<script>

export default {
  components: {
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
  methods: {
  },
  computed: {
    headerStyle() {
      return {
        backgroundImage: `url(${this.image})`
      };
    },
  },
  
};
</script>
<style lang="scss">
@media all and (min-width: 991px) {
  .btn-container {
    display: flex;
  }

}

</style>
