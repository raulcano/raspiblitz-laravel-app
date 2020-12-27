<template>
  <div class="wrapper">

    <div class="main main-raised">

      <div class="section section-navbars">
        <div class="container">
          <small-navigation></small-navigation>
        </div>
        <navigation></navigation>
      </div>
      <div class="section section-tabs">
        <div class="container">
          <tabs></tabs>
        </div>
      </div>
      <div class="section section-white">
        <div class="container">
          <nav-pills></nav-pills>
        </div>
      </div>
      <div class="section section-notifications">
        <div class="container">
          <div class="title">
            <h3>Notifications</h3>
          </div>
        </div>
        <notifications></notifications>
      </div>

      <div class="section section-javascript">
        <div class="container">
          <javascript-components></javascript-components>
        </div>
      </div>
      
      
      
      
    </div>
  </div> <!-- WRAPPER -->
</template>

<script>
import Tabs from "./components/TabsSection";
import NavPills from "./components/NavPillsSection";
import JavascriptComponents from "./components/JavascriptComponentsSection";

export default {
  components: {
    Tabs,
    NavPills,
    JavascriptComponents,
  },
  name: "index",
  bodyClass: "index-page",
  props: {
    image: {
      type: String,
      default: require("../assets/img/vue-mk-header.jpg")
    },
    leaf4: {
      type: String,
      default: require("../assets/img/leaf4.png")
    },
    leaf3: {
      type: String,
      default: require("../assets/img/leaf3.png")
    },
    leaf2: {
      type: String,
      default: require("../assets/img/leaf2.png")
    },
    leaf1: {
      type: String,
      default: require("../assets/img/leaf1.png")
    },
    signup: {
      type: String,
      default: require("../assets/img/city.jpg")
    },
    landing: {
      type: String,
      default: require("../assets/img/landing.jpg")
    },
    profile: {
      type: String,
      default: require("../assets/img/profile.jpg")
    }
  },
  data() {
    return {
      firstname: null,
      email: null,
      password: null,
      leafShow: false
    };
  },
  methods: {
    leafActive() {
      if (window.innerWidth < 768) {
        this.leafShow = false;
      } else {
        this.leafShow = true;
      }
    }
  },
  computed: {
    headerStyle() {
      return {
        backgroundImage: `url(${this.image})`
      };
    },
    signupImage() {
      return {
        backgroundImage: `url(${this.signup})`
      };
    }
  },
  mounted() {
    this.leafActive();
    window.addEventListener("resize", this.leafActive);
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.leafActive);
  }
};
</script>
<style lang="scss">
.section-download {
  .md-button + .md-button {
    margin-left: 5px;
  }
}

@media all and (min-width: 991px) {
  .btn-container {
    display: flex;
  }
}
</style>
