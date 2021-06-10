<template>
<div>
    <SupplierAdd v-if="isShowAdd" v-bind:isservice="1" @toggle-list="toggleList()" />
    <div class="container-xl" v-if="isShowList">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Service</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a @click="changIsShowAdd()" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Service</span></a>
                            <input class="form-group search" type="text" placeholder="search" v-model="inputSearch" @keyup="searchItem">
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th></th>
                             <th>Cost In Month </th>
                            <th>Name</th>
                           
                       
                            <th>Cost In Year</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item of supplierList" :key="item.id">
                          <td></td>
                           <router-link :to="{ name: 'statiscal', params: { id: item.id } }">
                                <td class="a-link">
                                    click me watch detail
                                </td>
                            </router-link>
                            <td>{{item.name}}</td>
                           
                           <router-link :to="{ name: 'statiscalyear', params: { id: item.id } }">
                                <td class="a-link">
                                     click me watch detail
                                </td>
                            </router-link>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>{{totalPage}}</b> entries</div>
                    <ul class="pagination">
                        <li :class="[currentPage ==1 ?'disabled':'','page-item']" @click="(currentPage>1)? currentPage-=1 :currentPage"><a href="#" class="page-link">Prev</a></li>
                        <li v-for="(item , index) of totalPage " :key="index" @click="currentPage = item" :class="[item==currentPage ?'active':'','page-item']">
                            <a class="page-link">{{item}}</a>
                        </li>
                        <li :class="[currentPage==totalPage ?'disabled':'','page-item']" @click="(currentPage<totalPage)? currentPage+=1 :currentPage"><a href="#" class="page-link">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <router-link 
            to="/addpsd"
        >
            <a class="add_service">
                Add New Service
            </a>

        </router-link>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapMutations,
    mapState
} from 'vuex'

import SupplierAdd from './SupplierAdd'

export default {
    computed: {
        ...mapState({
            supplierList: state => state.service.supplierList,
            totalPage: state => state.service.totalPage
        })
    },
    components: {
        SupplierAdd
    },
    data() {
        return {
            isShowAdd: false,
            isShowtable: false,
            isShowList: true,
            supplierChose: null,
            listSp: [],
            inputSearch: '',
            currentPage: 1,
            idShow: 1
        }
    },
    methods: {
        ...mapActions('service', ['getSupplier', 'deleteSupplier', 'getByPage']),
        ...mapMutations('service', ['findByName']),
        changIsShowAdd() {
            this.isShowAdd = !this.isShowAdd
            this.isShowList = false
        },
        showEdit(index) {
            this.isShowAdd = false
            this.isShowList = false
            this.supplierChose = this.supplierList[index]

        },
        toggleList() {
            this.isShowAdd = false,
                this.isShowList = !this.isShowList
        },
        deleteItem(id) {
            this.deleteSupplier(id);
        },
        searchItem(e) {
            if (e.keyCode === 13) {
                this.findByName(this.inputSearch);
            }
        }
    },
    created() {
        this.getByPage(this.currentPage);
    },
    watch: {
        inputSearch: function () {
            if (this.inputSearch == '') {
                this.getByPage(this.currentPage);
            }

        },
        currentPage: function () {
            this.getByPage(this.currentPage);
        }
    }
}
</script>

<style scoped>
.a-link {
    font-style: italic;
    text-decoration: underline;
    opacity: 0.7;
}
</style>
