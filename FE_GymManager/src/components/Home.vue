<template>
<div class="grey-bg container-fluid">
    <section id="minimal-statistics">
        <div class="row">
            <div class="col-12 mt-3 mb-1">
                <p>STATISTICS OF GYM ROOM DEVICES</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12" 
                v-for="item in statusList" 
                :key="item.id"  
                @click="showListStatus(item.id)"
                
                >
                <div :class="[idShow==item.id ?'active':'','card']">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">

                                    <i class="icon-graph success font-large-2 float-left"></i> </div>
                                <div class="media-body text-right">
                                    <h3>{{item.devices.length}}</h3>
                                    <span>{{item.name}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="icon-pointer danger font-large-2 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>{{numberDevice}}</h3>
                                    <span>TOTAL DEVICE</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end card body  -->

   

    <h3 class="list-device">List Of Devices</h3>
    <div class="table100 ver3 m-b-110">
        <div class="table100-head">
            <table>
                <thead>
                    <tr class="row100 head">
                        <th class="cell100 column1">Name</th>
                        <th class="cell100 column2">Type</th>
                        <th class="cell100 column3">Status</th>
                        <th class="cell100 column4">Department</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="table100-body js-pscroll">
            <table>
                <tbody>
                    <tr class="row100 body"
                        v-for="item in dataListId"
                        :key="item.id"
                    >
                        <td class="cell100 column1">{{item.name}}</td>
                        <td class="cell100 column2 ">{{(item.typemachine)?item.typemachine.name:"Empty"}}</td>
                        <td class="cell100 column3">{{(item.status)?item.status.name:"chua co"}}</td>
                        <td class="cell100 column4">{{(item.department)?item.department.name:"Empty"}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
     <Charts />
</div>
</template>

<script>
import {mapActions,mapState} from 'vuex'
import Charts from './Charts'
import StatusDevice from '../api/StatusDevice'
import Device from '../api/device'
export default {
    name: 'Home',
    computed: {
        ...mapState('status', ['statusList'])
    },
    data() {
        return {
            dataListId:[],
            idShow :1,
            numberDevice:null
        }
    },
    components: {
        Charts
    },
 
    methods: {
        ...mapActions('status', ['getStatus']),
        showListStatus(id) {
            this.dataListId = this.statusList[id-1].devices;
            this.idShow = id
        },
        takedata(){
            this.dataListId = this.statusList[0].devices;
        },
        takeDataById(){
            StatusDevice.show(this.idShow).then((response)=>{
                this.dataListId = response.data[0].devices
            })
        },takeNumberDevice(){
            Device.countAll().then(response=>this.numberDevice = response.data);
        }

    },
    created() {
        this.getStatus();
       this.takeDataById();
       this.takeNumberDevice();
    },
    mounted(){
        this.takedata();
    }
}
</script>

<style>
.active.card {
    background: rebeccapurple;
}
.list-device {
    margin: 70px 0 0 0;
    width: 100%;
    background: rebeccapurple;
    text-align: center;
    border-radius: 20px;
}

.table100 {
    margin: 30px 0;
}

.table100 .ps__rail-y {
    width: 9px;
    background-color: transparent;
    opacity: 1 !important;
    right: 5px;
}

.table100 .ps__rail-y::before {
    content: "";
    display: block;
    position: absolute;
    background-color: #ebebeb;
    border-radius: 5px;
    width: 100%;
    height: calc(100% - 30px);
    left: 0;
    top: 15px;
}

.table100 .ps__rail-y .ps__thumb-y {
    width: 100%;
    right: 0;
    background-color: transparent;
    opacity: 1 !important;
}

.table100 .ps__rail-y .ps__thumb-y::before {
    content: "";
    display: block;
    position: absolute;
    background-color: #cccccc;
    border-radius: 5px;
    width: 100%;
    height: calc(100% - 30px);
    left: 0;
    top: 15px;
}

.limiter {
    width: 1366px;
    margin: 0 auto;
}

.container-table100 {
    width: 100%;
    min-height: 100vh;
    background: #fff;

    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    padding: 33px 30px;
}

.wrap-table100 {
    width: 1170px;
}

/*//////////////////////////////////////////////////////////////////
[ Table ]*/
.table100 {
    background-color: #fff;
}

table {
    width: 100%;
}

th,
td {
    font-weight: unset;
    padding-right: 10px;
}

.column1 {
    width: 33%;
    padding-left: 40px;
}

.column2 {
    width: 13%;
}

.column3 {
    width: 22%;
}

.column4 {
    width: 19%;
}

.column5 {
    width: 13%;
}

.table100-head th {
    padding-top: 18px;
    padding-bottom: 18px;
}

.table100-body td {
    padding-top: 16px;
    padding-bottom: 16px;
}

/*==================================================================
[ Fix header ]*/
.table100 {
    position: relative;
    padding-top: 60px;
}

.table100-head {
    position: absolute;
    width: 100%;
    top: 0;
    left: 0;
}

.table100-body {
    max-height: 585px;
    overflow: auto;
}

/*==================================================================
[ Ver3 ]*/

.table100.ver3 {
    background-color: #393939;
}

.table100.ver3 th {
    font-family: Lato-Bold;
    font-size: 15px;
    color: #00ad5f;
    line-height: 1.4;
    text-transform: uppercase;
    background-color: #393939;
}

.table100.ver3 td {
    font-family: Lato-Regular;
    font-size: 15px;
    color: #808080;
    line-height: 1.4;
    background-color: #222222;
}

/*---------------------------------------------*/

.table100.ver3 {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    -webkit-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    -o-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    -ms-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
}

.table100.ver3 .ps__rail-y {
    right: 5px;
}

.table100.ver3 .ps__rail-y::before {
    background-color: #4e4e4e;
}

.table100.ver3 .ps__rail-y .ps__thumb-y::before {
    background-color: #00ad5f;
}
</style>
