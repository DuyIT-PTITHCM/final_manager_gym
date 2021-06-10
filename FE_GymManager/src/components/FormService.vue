<template>
<div>
    <!-- device  -->
    <div class=" contact-form form-post">
        <form @submit.prevent="AddPSD(partnerDevice)" method="post">
            <p class="title">Add New </p>
            <Calender />
            <div class="row">
                <div class="col-md-12">
                    <a class="a-link">Select Option Variable</a>
                    <br>
                    <select class="mdb-select md-form edit-m" v-model="partnerDevice.device_id">
                        <option value="" disabled selected>Choose your option</option>
                        <option v-for="item of dataDevice" :key="item.id" :value="item.id">{{item.name}}</option>
                    </select>
                    <br>
                    <!-- end device  -->

                    <!-- service  -->
                    <a @click="active1=!active1" class="a-link">Click below Add New Service Or Select Option Variable</a>
                    <Popup v-if=" active1 " :psd="1" />
                    <br>
                    <select class="mdb-select md-form edit-m " v-model="partnerDevice.service_id">
                        <option value="" disabled selected>Choose your option</option>
                        <option v-for="item of dataService" :key="item.id" :value="item.id">{{item.name}}</option>
                    </select>
                    <br>
                    <!-- end service  -->

                    <!-- partner  -->
                    <a @click="active2=!active2" class="a-link">Click below Add New Partner Or Select Option Variable</a>
                    <Popup v-if="active2 " :psd="2" />
                    <br>
                    <select class="mdb-select md-form edit-m" v-model="partnerDevice.partner_id">
                        <option value="" disabled selected>Choose your option</option>
                        <option v-for="item of dataPartner" :key="item.id" :value="item.id">{{item.name}}</option>
                    </select>
                    <br>
                    <!-- end partner  -->
                    <br>
                    <a class="a-link"> Input Hear Cost Service</a>
                    <!-- cost service  -->
                    <div class="form-group ">
                        <input type="text" name="price" class="form-control" placeholder="Cost Service *" v-model="partnerDevice.price" />
                    </div>
                    <!-- end cost service  -->
                    <DatePicker 
                        mode='range' 
                        v-model='range' 
                        input="onDateRangeChange" 
                        is-inline :columns="$screens({ default: 1, lg: 2 })" 
                    />
                    
                    <br>
                    <br>
                    <br>
                    <div class="form-group">
                        <input type="submit" name="btnSubmit" class="btnContact" value="Save " />
                    </div>
                </div>

            </div>

        </form>
        <router-link 
            to="/service"
        >
            <a class="add_service">
                Go back
            </a>

        </router-link>
    </div>
</div>
</template>

<script>
import {
    DatePicker
} from 'v-calendar'
import Popup from './Popup'
import Device from '../api/device'
import PSD from '../api/psd'
import {
    mapActions,
    mapState
} from 'vuex'

export default {
    components: {
        Popup,
        DatePicker
    },
    computed: {
        ...mapState({
            dataService: state => state.service.allItems,
            dataPartner: state => state.partner.allItems
        })
    },
    data() {
        return {
            partnerDevice: {
                device_id: null,
                service_id: null,
                partner_id: null,
                price: null,
                enddate: null
            },
            active1: false,
            active2: false,
            dataDevice: null,
            range: {
                start: new Date(),
                end: null
            }
        }
    },
    methods: {
        ...mapActions('service', ['getSe']),
        ...mapActions('partner', ['getPa']),
        takeDataDevice() {
            Device.getAll().then((response) => {
                this.dataDevice = response.data
            })
        },
        AddPSD(data) {
            PSD.store(data).then(() => {
                 alert('Add successful')
                 this.$router.push({ path: 'service' })
                
                })
                .catch(() => {
                    alert('Add Failure')
                })
        }

    },
    created() {
        this.takeDataDevice();
        this.getSe();
        this.getPa();
    },
    watch: {
        range: {
            handler: function () {
                this.partnerDevice.enddate  =  this.range.getFullYear() +'-'+ (this.range.getMonth()+1)+'-'+this.range.getDate() +' 00:00:00';
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
