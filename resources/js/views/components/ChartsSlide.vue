<template>
    <div> <!-- GENERAL container -->

        <div v-if="chartsSettings.chart">
            CHART GOES HERE: <br>
            {{chartsSettings.chart_type}}, {{chartsSettings.chart_period}}
        </div>
        
        
        
        
        <md-button class="md md-lg md-success"
            @click.prevent="refreshCharts">

            <div v-if="refreshing === false">
                <h5>{{last_price}} {{chartsSettings.BTC_currency}}</h5>
            </div>
            <div v-else-if="refreshing === true" class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </md-button>

    </div>
</template>
<script>
export default {
    name: "charts-slide",
    data() {
        return {
            refreshing: false,
            status: [],
            last_price: ''
        };
    },
    methods: {
        refreshCharts(){
            this.refreshing = true;
            axios
            .get('https://blockchain.info/ticker')
            .then(res => {
                this.last_price = res.data[this.chartsSettings.BTC_currency].last;
                this.refreshing = false;
            });
        }
    },
    mounted() {
        this.refreshCharts();
        this.loadSettingsFromDB();

        setInterval(function () {
            this.refreshCharts();
        }.bind(this), 30000); 
    } 
}
</script>
<style scoped>
h1 {
    text-transform: uppercase;
}
</style>