<template>
    <DatePicker 
    mode='range' 
    v-model='range' 
    input="onDateRangeChange" 
    is-inline :columns="$screens({ default: 1, lg: 2 })" 
    />
</template>

<script>
import {
    DatePicker
} from 'v-calendar'

export default {
    name: 'Booking',
    components: {
        DatePicker
    },
    data() {
        return {
            range: {
                start: new Date(),
                end: null
            }
        }
    },
    watch: {
        range: {
            handler: function () {
                console.log(this.range)
            },
            deep: true
        }
    },
    mounted() {
        this.$root.$on('input', (value) => {
            console.log('dxggdfg'+value);
        });
    }
}
</script>
