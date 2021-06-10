<template>
<div>
    <SupplierAdd v-if="isShowAdd" @toggle-list="toggleList()" :check="7" @reload-page-add="reloadAdd()"/>
    <SupplierEdit v-if="isShowEdit" :supplierItem="supplierChose"  @toggle-list="toggleList()"  @reload-page="reload()"  :check="7"/>
    <div class="container-xl" v-if="isShowList">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 >Manage <b>Department</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a @click="changIsShowAdd()" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Department</span></a>
                            <input  class="form-group search" type="text" placeholder="search" v-model="inputSearch" @keyup="searchItem" >
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th></th>
                            <th>Manager Department</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) of supplierList" :key="item.id" >
                            <td></td>
                            <td  @click="showDetailDevice(item.id)">{{item.name}}</td>
                            <td></td>
                            <td>{{(item.user)?item.user.name:'Empty'}}</td>
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
export default {
    computed: {
        ...mapState({
            supplierList :state =>state.department.supplierList,
            totalPage :state=>state.department.totalPage
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
        ...mapActions('department', ['getSupplier','deleteSupplier','getByPage']),
        ...mapMutations('department',['findByName']),
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
        reload(){
            alert('update success');
            this.getByPage(this.currentPage);

        },
        reloadAdd(){
            alert('insert success');
            this.getByPage(this.currentPage);
        },
        showDetailDevice(idCC){
           this.$router.push({ name: 'detail_partment', params: { id: idCC } })
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

