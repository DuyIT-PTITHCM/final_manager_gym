<template>
<div>
    <SupplierAdd v-if="isShowAdd" @toggle-list="toggleList()" :check="1" @reload-page-device="reloadAdd()"/>
    <SupplierEdit v-if="isShowEdit" :supplierItem="supplierChose"  @toggle-list="toggleList()"  :check="1"/>
    <div class="container-xl" v-if="isShowList">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 >Manage <b>Supplier</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a @click="changIsShowAdd()" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
                            <input  class="form-group search" type="text" placeholder="search" v-model="inputSearch" @keyup="searchItem" >
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) of supplierList" :key="item.id">
                            <td></td>
                            <td>{{item.name}}</td>
                            <td>{{item.address}}</td>
                            <td>{{item.phone}}</td>
                            <td>
                                <a @click="showEdit(index)" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a @click="deleteItem(item.id)" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>{{totalPage}}</b> entries</div>
                    <ul class="pagination">
                        <li :class="[currentPage ==1 ?'disabled':'','page-item']" @click="(currentPage>1)? currentPage-=1 :currentPage"><a href="#" class="page-link">Prev</a></li>
                        <li
                             v-for="(item , index) of totalPage " 
                            :key="index" @click="currentPage = item"
                            :class="[item==currentPage ?'active':'','page-item']"
                            >
                            <a  class="page-link">{{item}}</a>
                        </li>
                        <li :class="[currentPage==totalPage ?'disabled':'','page-item']" @click="(currentPage<totalPage)? currentPage+=1 :currentPage"><a href="#" class="page-link">Next</a></li>
                    </ul>
                </div>
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
import SupplierAdd from './SupplierAdd'
import SupplierEdit from './SupplierEdit'
import Supplier from '../api/Supplier'
export default {
    computed: {
        ...mapState({
            supplierList :state =>state.supplier.supplierList,
            totalPage :state=>state.supplier.totalPage
        })
    },
    components: {
        SupplierAdd,
        SupplierEdit
    },
    data() {
        return {
            isShowAdd: false,
            isShowEdit: false,
            isShowList: true,
            supplierChose:null,
            listSp :[],
            inputSearch:'',
            currentPage:1
        }
    },
    methods: {
        ...mapActions('supplier', ['getSupplier','deleteSupplier','getByPage']),
        ...mapMutations('supplier',['findByName']),
        changIsShowAdd() {
            this.isShowAdd = !this.isShowAdd
            this.isShowEdit = false,
            this.isShowList=false
        },
        showEdit(index){
            this.isShowAdd = false
             this.isShowList=false
            this.isShowEdit = !this.isShowEdit
             this.supplierChose=this.supplierList[index]
            
        },
        takeData(){
            Supplier.get().then((response)=>{
                this.listSp = response.data
            })
        },
        toggleList(){
            this.isShowAdd =false,
            this.isShowEdit = false,
            this.isShowList = !this.isShowList
        },
        deleteItem(id){
            this.deleteSupplier(id);
        },
        searchItem(e){
            if(e.keyCode ===13){
                this.findByName(this.inputSearch);
            }
        },
        reloadAdd(){
            this.getByPage();
        }
    },
    created() {
        this.getByPage(this.currentPage);
    },
    watch:{
        inputSearch:function(){
            if(this.inputSearch==''){
                this.getByPage(this.currentPage);
            }
            
        },
        currentPage:function(){
            console.log(this.currentPage)
            this.getByPage(this.currentPage);
        }
    }
}
</script>

