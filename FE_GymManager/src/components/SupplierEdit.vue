<template>
<div class=" contact-form">
    <div class="contact-image">
        <img src="../assets/fly.png" alt="rocket_contact" />
    </div>
    <form method="post" @submit.prevent="updateNow(supplierItem.id,supplierItem)">
        <p class="title">Update information {{supplierItem.name}}</p>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="name" v-model="supplierItem.name" class="form-control w-5" placeholder="Your Name *" />
                </div>
                <div class="form-group" v-if="check == 6">
                    <input type="number" name="pricebuy" class="form-control" placeholder="Your Price Buy *" v-model="supplierItem.pricebuy" />
                </div>

                <div class="form-group" v-if="check !=4 && check !=5  && check !=6  && check !=7 ">
                    <input type="text" name="address" class="form-control w-5" placeholder="Your Address *" v-model="supplierItem.address" />
                </div>
                <div class="form-group" v-if="check ==5  " >
                    <input type="text" name="mail" :disabled="check == 5" class="form-control w-5" placeholder="Your Email *" v-model="supplierItem.email" />
                </div>
                <select class="mdb-select md-form w-5" v-model="supplierItem.role_id" v-if="check==5">
                    <option value="" disabled selected>Choose your option</option>
                    <option v-for="roleItem of dataRole" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <div class="form-group" v-if="check !=4  &&  check !=7  && check !=6 ">
                    <input type="text" name="phone" v-model="supplierItem.phone" class="form-control w-5" placeholder="Your Phone Number *" />
                </div>

                   <!-- role select  -->
                <p v-if="check==6">Select Status Of Device</p>
                <select class="mdb-select md-form" v-model="supplierItem.status_id" v-if=" check==6">
                    <option value="" disabled selected>Choose your option</option>
                    <option v-for="roleItem of dataStatus" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <!-- end role select  -->

                 <!-- type machine select  -->
                <a v-if="check==6" @click="active1=!active1" class="a-link">Click below Add New Type Machine Or Select Option Variable</a>
                <select class="mdb-select md-form edit-w" v-model="supplierItem.type_machine_id" v-if="check==6" >
                    <option value="" disabled selected>Choose your option</option>
                    <option v-for="roleItem of allItems" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <br>
                <!-- end type machine select  -->
                <!-- department select  -->
                <a v-if="check==6" @click="active2 =! active2 " class="a-link">Click below Add New Department Or Select Option Variable</a>
                <select class="mdb-select md-form edit-w" v-model="supplierItem.department_id" v-if="check==6">
                    <option value="" disabled  >Choose your option</option>
                    <option v-for="roleItem of allDe" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <!-- end department select  -->

                <!-- Supplier select  -->
                 <a  v-if="check==6" @click="active3=!active3" class="a-link">Click below Add New Supplier Or Select Option Variable</a>
                <select class="mdb-select md-form edit-w" v-model="supplierItem.supplier_id" v-if="check==6">
                    <option value="" disabled>Choose your option</option>
                    <option v-for="roleItem of allSu" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <!-- end supplier select  -->
                <!-- Data select  -->
                 <a  v-if="check==7" class="a-link">Select Option Variable Employee Of Department</a>
                <select class="mdb-select md-form edit-w" v-model="supplierItem.user_id" v-if="check==7">
                    <option value="" disabled>Choose your option</option>
                    <option v-for="roleItem of dataUser" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <!-- end data user select  -->

                <div class="form-group">
                    <input type="submit" name="btnSubmit" class="btnContact w-5" value="Save" />
                    <a class="btnContact text-light bg-dark  close" @click="showList">Go back</a>
                </div>
            </div>
        </div>
    </form>
</div>
</template>

<script>
import User from '../api/user'
import Status from '../api/StatusDevice'
import {
    mapActions, mapState
} from 'vuex'
import Role from '../api/role'
export default {
    props: ['supplierItem', 'check'],
    computed:{
        ...mapState({
            allItems :state =>state.typemachine.allItems,
            allDe :state =>state.department.allItems,
            allSu :state =>state.supplier.allItems,
        })
    },
    data() {
        return {
            dataRole: null,
            dataUser:null,
            dataStatus:null
        }
    },
    methods: {
        ...mapActions('supplier', ['update','getSu']),
        ...mapActions('user', ['updateUser']),
        ...mapActions('sales', ['updateSales']),
        ...mapActions('partner', ['editPartner']),
        ...mapActions('typemachine', ['updateTypeMachine','getType']),
        ...mapActions('department',['updateDepartment','getDe']),
        ...mapActions('device',['updateDevice','getSupplier']),
         updateNow(id, data) {
            if (this.check == 1) {
                this.update({
                    id: id,
                    data: data
                });
            } else if (this.check == 2) {
                this.updateSales({
                    id: id,
                    data: data
                })
            } else if (this.check == 3) {
                this.editPartner({
                    id: id,
                    data: data
                })
            } else if (this.check == 4) {
                this.updateTypeMachine({
                    id: id,
                    data: data
                })
            }else if (this.check == 5) {
                this.updateUser({
                    id: id,
                    data: data
                })
                this.$emit('reload-update-user');
            }else if (this.check == 6) {
                this.updateDevice({
                    id: id,
                    data: data
                })
                this.$emit('reload-edit-device');
                
            }
            else if (this.check == 7) {
                 this.updateDepartment({
                    id: data.id,
                    data:data
                })
                this.$emit('reload-page');
                 
                
            }
            this.$emit('toggle-list')
        },
        showList() {
            this.$emit('toggle-list')
        },
        takeDataRole() {
            Role.get().then((response) => {
                this.dataRole = response.data
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
        this.takeDataRole();
        this.takeDataUser();
        this.getType();
        this.getDe();
        this.getSu();
        this.takeDataStatus();
    }

}
</script>

<style scoped>
select {
    width: 100%;
    outline: none;
    margin-bottom: 45px;
    border-radius:15px ;
}

.w-5 {
    width: 700px;
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
