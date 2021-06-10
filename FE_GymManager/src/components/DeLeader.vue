<template>
<div>
    <LeaderEdit v-if="isShowEdit" :passDevice="deviceChose" @toggle-list="toggleList()" @reload-page="reloadNow()" />

    <div class="container-xl" v-if="isShowList">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Device {{dataDevice.name}}</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-group search" type="text" placeholder="search" v-model="inputSearch" @keyup="searchItem">

                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Price Buy</th>
                            <th>Name</th>
                            <th>Type Machine</th>
                            <th>Status</th>
                            <th>Department</th>
                            <th>Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) of dataDevice.devices" :key="item.id">
                            <td>{{formatPrice(item.pricebuy) }} VNĐ</td>
                            <td>{{item.name}}</td>
                            <td>{{(item.typemachine)?item.typemachine.name:'Empty'}}</td>
                            <td>{{(item.status)?item.status.name:'Empty'}}</td>
                            <td>{{(item.department)?item.department.name:'Empty'}}</td>
                            <td>{{(item.supplier)?item.supplier.name:'Empty'}}</td>
                            <td>
                                <a @click="showEdit(index)" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapMutations,
    mapState
} from 'vuex'
import LeaderEdit from './LeaderEdit.vue'
export default {
    components: {
        LeaderEdit
    },
    data() {
        return {
            inputSearch: null,
            isShowEdit: false,
            deviceChose: null,
            isShowList: true,
        }
    },
    computed: {
        ...mapState({
            dataDevice: state => state.client.dataDevice
        })
    },
    methods: {
        ...mapActions('client', ['getDataDevice']),
        ...mapMutations('client', ['findByName']),
        searchItem(e) {
            if (e.keyCode === 13) {
                this.findByName(this.inputSearch);
            }
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        showEdit(index) {
            this.isShowList = false
            this.isShowEdit = !this.isShowEdit
            this.deviceChose = this.dataDevice.devices[index]

        },
        toggleList() {
            this.isShowEdit = false,
            this.isShowList = !this.isShowList
        },
        reloadNow() {
            this.isShowEdit = false,
            this.isShowList = !this.isShowList
            this.getDataDevice();
        }
    },
    created() {
        this.getDataDevice();
    },
    watch: {
        inputSearch: function () {
            if (this.inputSearch == '') {
                this.getDataDevice();
            }

        }
    }
}
</script>
