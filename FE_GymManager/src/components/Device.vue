<template>
<div>
    
    <SupplierAdd v-if="isShowAdd" @toggle-list="toggleList()" :check="6" @reload-page-device="reloadAddDevice()" />
    <SupplierEdit v-if="isShowEdit" :supplierItem="supplierChose"  @toggle-list="toggleList()"  :check="6" @reload-edit-device="reloadUpdate()"/>
    <div class="container-xl" v-if="isShowList">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-3">
                            <h2 >Manage <b>Device</b></h2>
                            
                        </div>
                        <div class="col-sm-3">
                            <select class="browser-default custom-select " v-model="fillterSelected" aria-placeholder="fillter" >
                                <option v-for="item in listStatus" :key="item.id" :value="item.id">{{item.name}} </option>   
                            </select>
                        </div>
                        <div class="col-sm-6">
                            
                            <a @click="changIsShowAdd()" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Device</span></a>
                            <input  class="form-group search" type="text" placeholder="Search" v-model="inputSearch" @keyup="searchItem" >
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
                        <tr v-for="(item,index) of supplierList" :key="item.id">
                            <td>{{item.pricebuy}}</td>
                            <td>{{item.name}}</td>
                            <td>{{(item.typemachine)?item.typemachine.name:'Empty'}}</td>
                            <td>{{(item.status)?item.status.name:'Empty'}}</td>
                            <td>{{(item.department)?item.department.name:'Empty'}}</td>
                            <td>{{(item.supplier)?item.supplier.name:'Empty'}}</td>
                            <td>
                                <a @click="showEdit(index)" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a @click="deleteItem(item.id)" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>10</b> out of <b>{{totalPage}}</b> entries</div>
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
import StatusList from '../api/StatusDevice'
export default {
    computed: {
        ...mapState({
            supplierList :state =>state.device.supplierList,
            totalPage :state=>state.device.totalPage
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
            currentPage:1,
            fillterSelected :null,
            listStatus :null
        }
    },
    methods: {
        ...mapActions('device', ['getSupplier','deleteSupplier','getByPage','fillterByStatus']),
        ...mapMutations('device',['findByName','FILLTER']),
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
        reloadAddDevice(){
            this.getByPage(this.currentPage);
        },reloadUpdate(){
            this.getByPage(this.currentPage);
        },
        async getAllListStatus(){
            let listStatus = await StatusList.getAll();
            this.listStatus = listStatus.data;
        },
        async getChange(){
            await this.getSupplier();
            await this.FILLTER(this.fillterSelected);
        }


    },
    created() {
        this.getByPage(this.currentPage);
        this.getAllListStatus();
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
        },
        fillterSelected :function(){
            // await this.getSupplier();
            this.fillterByStatus(this.fillterSelected);
            
        }
    }
}
</script>

