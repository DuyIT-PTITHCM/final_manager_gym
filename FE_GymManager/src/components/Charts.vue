<template>
<div class="chart-pie">
    <p @click="abc">Statistical Chart Of Gym Devices Status</p>
    <GChart type="PieChart" :data="xxx" :options="chartOptions" />
</div>
</template>

<script>
import {
    GChart
} from "vue-google-charts";
import {  mapGetters, mapState } from 'vuex';

export default {
    name: 'Charts',
    components: {
        GChart
    },
    computed: {
        ...mapState('status', ['statusList']),
        ...mapGetters('status',['getDataCharts'])
    },
    data() {
        return {
            xxx:this.getDataCharts,
            chartOptions: {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                }
            }
        };
    },
    methods: {
        abc(){
            this.xxx = this.getDataCharts
        }
    },
    created(){
        this.xxx= this.getDataCharts
    }
}
</script>

