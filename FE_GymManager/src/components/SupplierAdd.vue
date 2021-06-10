<template>
<div class=" contact-form form-post">
    <div class="contact-image">
        <img src="../assets/fly.png" alt="rocket_contact" />
    </div>
    <form @submit.prevent="AddSupplierFrom(supplier)" method="post">
        <p class="title">Add New </p>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" >
                    <input type="text" name="name" class="form-control" placeholder="Your Name *" v-model="supplier.name" />
                </div>
                <div class="form-group" v-if="check == 6 && isservice  !=1">
                    <input type="number" name="pricebuy" class="form-control" placeholder="Your Price Buy *" v-model="supplier.pricebuy" />
                </div>

                <div class="form-group" v-if="check !=4 && check !=5 && check !=6 && check !=7 && isservice  !=1">
                    <input type="text" name="address" class="form-control" placeholder="Your Address *" v-model="supplier.address" />
                </div>
                <div class="form-group" v-if="check ==5 && check !=6 && check !=7">
                    <input type="text" name="mail" class="form-control" placeholder="Your Email *" v-model="supplier.email" />
                </div>
                <div class="form-group" v-if="check !=4 && check !=6  && check !=7  && isservice  !=1 ">
                    <input type="text" name="phone" class="form-control" placeholder="Your Phone Number *" v-model="supplier.phone" />
                </div>
                <!-- role select  -->
                <p v-if="check==5">Select Role Of User</p>
                <select class="mdb-select md-form" v-model="supplier.role_id" v-if=" check==5">
                    <option value="" disabled selected>Choose your option</option>
                    <option v-for="roleItem of dataRole" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <!-- end role select  -->
                <!-- role select  -->
                <p v-if="check==6">Select Status Of Device</p>
                <select class="mdb-select md-form" v-model="supplier.status_id" v-if=" check==6">
                    <option value="" disabled selected>Choose your option</option>
                    <option v-for="roleItem of dataStatus" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <!-- end role select  -->
                <!-- type machine select  -->
                <a v-if="check==6" @click="active1=!active1" class="a-link">Click below Add New Type Machine Or Select Option Variable</a>
                <Popup v-if="check==6 && active1 " :check="4" />
                <select class="mdb-select md-form edit-m" v-model="supplier.type_machine_id" v-if="check==6" >
                    <option value="" disabled selected>Choose your option</option>
                    <option v-for="roleItem of allItems" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <br>
                <!-- end type machine select  -->
                <!-- department select  -->
                <a v-if="check==6" @click="active2 =! active2 " class="a-link">Click below Add New Department Or Select Option Variable</a>
                <Popup v-if="check==6 && active2 " :check="7" :cc="7"/>
                <select class="mdb-select md-form edit-m" v-model="supplier.department_id" v-if="check==6">
                    <option value="" disabled  >Choose your option</option>
                    <option v-for="roleItem of allDe" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <!-- end department select  -->
                <br>
                <!-- Supplier select  -->
                 <a  v-if="check==6" @click="active3=!active3" class="a-link">Click below Add New Supplier Or Select Option Variable</a>
                 <Popup v-if="check==6 && active3 " :check="1"/>
                <select class="mdb-select md-form edit-m" v-model="supplier.supplier_id" v-if="check==6">
                    <option value="" disabled>Choose your option</option>
                    <option v-for="roleItem of allSu" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <!-- end supplier select  -->

                <!-- User select  -->
                 <a  v-if="check==7" class="a-link">Select Option Variable Employee Of Department</a>
                <select class="mdb-select md-form edit-m" v-model="supplier.user_id" v-if="check==7">
                    <option value="" disabled>Choose your option</option>
                    <option v-for="roleItem of dataUser" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <!-- end User select  -->

                <div class="form-group">
                    <input type="submit" name="btnSubmit" class="btnContact" value="Save " />
                    <a class="btnContact text-light bg-dark  close" @click="showList" v-if="modal!=100">Go back</a>
                </div>

            </div>
        </div>
    </form>
</div>
</template>

<script>
import {
    mapActions, mapState
} from 'vuex'
import Role from '../api/role'
import TypeMachineApi from '../api/typemachine'
import DepartmentApi from '../api/department'
import SupplierApi from '../api/Supplier'
import User from '../api/user'
import Popup from './Popup'
import Status from '../api/StatusDevice'
import Helper from '../checkPhoneNumber'
export default {
    props: ['check', 'modal','isservice'],
    computed:{
        ...mapState({
            allItems :state =>state.typemachine.allItems,
            allDe :state =>state.department.allItems,
            allSu :state =>state.supplier.allItems,
        })
    },
    components:{
        Popup
    },
    data() {
        return {
            supplier: {
                name: '',
                email: '',
                phone: '',
                address: '',
                password: '123456789',
                role_id: 2,
                pricebuy: null,
                type_machine_id: null,
                department_id: null,
                supplier_id: null,
                user_id:null,
                status_id:null
            },
            dataRole: null,
            dataTypeMachine: null,
            dataDepartment: null,
            dataSupplier: null,
            dataUser:null,
            active1:false,
            active3:false,
            active2:false,
            dataStatus:null

        }
    },
    methods: {
        ...mapActions('supplier', ['addSupplier','getSu']),
        ...mapActions('sales', ['addSales']),
        ...mapActions('partner', ['addPartner']),
        ...mapActions('typemachine', ['addTypeMachine','getType']),
        ...mapActions('user', ['addUser']),
        ...mapActions('department',['addDepartment','getDe']),
        ...mapActions('device',['addDevice','getSupplier']),
        ...mapActions('service',['addService']),
        showList() {
            this.$emit('toggle-list')
        },
        AddSupplierFrom(data) {
            if (this.check == 1) {
                let phone = data.phone;
                if(phone !=''){
                    if(Helper.checkPhoneNumber(phone)){
                        this.addSupplier(data);
                         this.$emit('toggle-list')
                    }else{
                        alert('phone not validate')
                    }
                }
            } else if (this.check == 2) {
                let phone = data.phone;
                if(phone !=''){
                    if(Helper.checkPhoneNumber(phone)){
                       this.addSales(data)
                        this.$emit('toggle-list')
                    }else{
                        alert('phone not validate')
                    }
                }
               
            } else if (this.check == 3) {
                let phone = data.phone;
                if(phone !=''){
                    if(Helper.checkPhoneNumber(phone)){
                       this.addPartner(data)
                        this.$emit('toggle-list')
                    }else{
                        alert('phone not validate')
                    }
                }   
            } else if (this.check == 4) {
                this.addTypeMachine(data)
            } else if (this.check == 5) {
                let phone = data.phone;
                if(phone !=''){
                    if(Helper.checkPhoneNumber(phone)){
                        this.addUser(data);
                        this.$emit('reload-page');
                         this.$emit('toggle-list')
                    }else{
                        alert('phone not validate')
                    }
                }  
                
            }
            else if(this.check == 7){
                this.addDepartment(data);
                this.$emit('reload-page-add');
                 this.$emit('toggle-list')
                
            }else if(this.check == 6){
                this.addDevice(data);
                this.$emit('reload-page-device');
                 this.$emit('toggle-list')
            }
            else if(this.isservice==1){
              this.addService(data);
               this.$emit('toggle-list')

            }
            
        },
        takeDataRole() {
            Role.get().then((response) => {
                this.dataRole = response.data
            })
        },
        takeDataTypeMachine() {
            TypeMachineApi.getAll().then((response) => {
                this.dataTypeMachine = response.data
            })
        },
        takeDataDepartment() {
            DepartmentApi.getAll().then((response) => {
                this.dataDepartment = response.data
            })
        },
        takeDataSupplier() {
            SupplierApi.getAll().then((response) => {
                this.dataSupplier = response.data
          
            })
        },
        takeDataUser() {
            User.getAll().then((response) => {
                this.dataUser = response.data
            })
        },
        takeDataStatus(){
            Status.getAll().then((response)=>{
                this.dataStatus = response.data
            })
        }
    },
    created() {
        this.getType();
        this.getDe();
        this.getSu();
        this.takeDataRole();
        this.takeDataTypeMachine();
        this.takeDataDepartment();
        this.takeDataSupplier();
        this.takeDataUser();
        this.takeDataStatus();

    }
}
</script>

<style >
.edit-m{width: 50%;
    height: 25px;
    margin-left: 50px;
}
.a-link{
    text-decoration: underline;
    font-style: italic;
    color: blue;
}
.contact-form form[data-v-23dbbeb5] {
    padding: 20px !important;
}

.title {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: crimson;
}

.contact-form {
    background: #fff;
    margin-bottom: 5%;
    width: 100%;
}

.contact-form .form-control {
    border-radius: 1rem;
}

.contact-image {
    text-align: center;
}

select {
    width: 100%;
    outline: none;

    margin-bottom: 10px;
    border-radius: 15px;
    border: 1px #dcdada solid !important;
}

.contact-image img {
    border-radius: 6rem;
    width: 11%;
    margin-top: -3%;
    transform: rotate(29deg);
}

.contact-form form {
    padding: 14%;
}

.contact-form form .row {
    margin-bottom: -7%;
}

.contact-form h3 {
    margin-bottom: 8%;
    margin-top: -10%;
    text-align: center;
    color: #0062cc;
}

.contact-form .btnContact {
    width: 50%;
    border: none;
    border-radius: 1rem;
    padding: 1.5%;
    background: #dc3545;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
}

.btnContactSubmit {
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    color: #fff;
    background-color: #0062cc;
    border: none;
    cursor: pointer;
}
</style>
