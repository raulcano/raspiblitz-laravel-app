<template>
    <div> <!-- GENERAL container -->
        
        <div id="status-container" style="color: black">
            <div id="title">
                <!-- blockchain info -->
                <h1>{{status.info_state}}</h1>
                <h6>{{status.info_message}} | <span class="text-warning"><strong>{{status.info_network}} ({{status.info_chain}})</strong></span></h6>
                <h6>Public IP: <strong>{{status.conf_publicIP}}</strong></h6>


                <!-- host info -->
                <h6>
                <span class="badge badge-primary">{{status.conf_hostname}}</span>
                 running
                <span class="badge badge-info">{{status.info_baseimage}} ({{status.info_cpu}})</span>, 
                 with Raspiblitz
                <span class="badge badge-warning"> {{status.conf_raspiBlitzVersion}}</span>
                </h6>
                <br>
                <br>
                <br>
            </div>
            
        </div>
        <h4>
        <md-button class="md md-lg"
            @click.prevent="refreshStatus">
            <div v-if="refreshing === false">
                <md-icon>refresh</md-icon> Refresh
            </div>
            <div v-else-if="refreshing === true" class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </md-button>
        </h4>
    </div>
</template>
<script>
export default {
    name: "status-slide",
    data() {
        return {
            refreshing: false,
            status: []
        };
    },
    methods: {
        refreshStatus(){
            this.refreshing = true;
            axios
            .get('/refreshStatus')
            .then(res => {
                this.status = res.data;
                this.refreshing = false;
            });
        }
    },
    mounted() {
        this.refreshStatus();
    }   
}
</script>
<style scoped>
h1 {
    text-transform: uppercase;
}
</style>