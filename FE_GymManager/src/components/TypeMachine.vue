<template>
<div>
    <SupplierAdd v-if="isShowAdd" @toggle-list="toggleList()" :check="4" />
    <SupplierEdit v-if="isShowEdit" :supplierItem="supplierChose"  @toggle-list="toggleList()"  :check="4"/>
    <div class="container-xl" v-if="isShowList">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 >Type Of Devices</h2>
                        </div>
                        <div class="col-sm-6">
                            <a @click="changIsShowAdd()" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Type Machine</span></a>
                            <input  class="form-group search" type="text" placeholder="search" v-model="inputSearch" @keyup="searchItem" >
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th> Refer Device</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) of supplierList" :key="item.id">
                            <td></td>
                            <td>{{item.name}}</td>
                            <td @click="showDetailDevice(item.id)"><a class="detail-list"> Detail List Device</a></td>
                            <td></td>
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
            supplierList :state =>state.typemachine.supplierList,
            totalPage :state=>state.typemachine.totalPage
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
        ...mapActions('typemachine', ['getSupplier','deleteSupplier','getByPage']),
        ...mapMutations('typemachine',['findByName']),
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
        showDetailDevice(idCC){
           this.$router.push({ name: 'detail_type', params: { id: idCC } })
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

<style>
.search {
    border-radius: 5px;
    width: 250px;
    outline: none;
}
.detail-list{
    font-weight: 100;
    color: blue;
    font-size: 13px;
    font-style: italic;
}
.table-responsive {
    margin: 30px 0;
}

.table-wrapper {
    background: #fff;
    padding: 20px 25px;
    border-radius: 3px;
    min-width: 1000px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
}

.table-title {
    padding-bottom: 15px;
    background: #435d7d;
    color: #fff;
    padding: 16px 30px;
    min-width: 100%;
    margin: -20px -25px 10px;
    border-radius: 3px 3px 0 0;
}

.table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
}

.table-title .btn-group {
    float: right;
}

.table-title .btn {
    color: #fff;
    float: right;
    font-size: 13px;
    border: none;
    min-width: 50px;
    border-radius: 2px;
    border: none;
    outline: none !important;
    margin-left: 10px;
}

.table-title .btn i {
    float: left;
    font-size: 21px;
    margin-right: 5px;
}

.table-title .btn span {
    float: left;
    margin-top: 2px;
}

table.table tr th,
table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
}

table.table tr th:first-child {
    width: 60px;
}

table.table tr th:last-child {
    width: 100px;
}

table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}

table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}

table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}

table.table td:last-child i {
    opacity: 0.9;
    font-size: 22px;
    margin: 0 5px;
}

table.table td a {
    font-weight: bold;
    color: #566787;
    display: inline-block;
    text-decoration: none;
    outline: none !important;
}

table.table td a:hover {
    color: #2196F3;
}

table.table td a.edit {
    color: #FFC107;
}

table.table td a.delete {
    color: #F44336;
}

table.table td i {
    font-size: 19px;
}

table.table .avatar {
    border-radius: 50%;
    vertical-align: middle;
    margin-right: 10px;
}

.pagination {
    float: right;
    margin: 0 0 5px;
}

.pagination li a {
    border: none;
    font-size: 13px;
    min-width: 30px;
    min-height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 2px !important;
    text-align: center;
    padding: 0 6px;
}

.pagination li a:hover {
    color: #666;
}

.pagination li.active a,
.pagination li.active a.page-link {
    background: #03A9F4;
}

.pagination li.active a:hover {
    background: #0397d6;
}

.pagination li.disabled i {
    color: #ccc;
}

.pagination li i {
    font-size: 16px;
    padding-top: 6px
}

.hint-text {
    float: left;
    margin-top: 10px;
    font-size: 13px;
}
</style>
