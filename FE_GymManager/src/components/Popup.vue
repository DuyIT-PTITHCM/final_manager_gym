<template>
<div class=" contact-form form-post">
    <form @submit.prevent="AddSupplierFrom(supplier)" method="post">
        <p class="title">Add New </p>
        <div class="row">
            <div class="col-md-8">
                <!-- name  -->
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name *" v-model="supplier.name" />
                </div>
                <!-- end name  -->
                <!-- address  -->
                <div class="form-group" v-if="check !=4 && check !=5 && check !=6 && check !=7 && psd !=1 ">
                    <input type="text" name="address" class="form-control" placeholder="Your Address *" v-model="supplier.address" />
                </div>
                <!-- end address  -->
                <!-- mail  -->
                <div class="form-group" v-if="check ==5 && check !=6 && check !=7 && psd !=1  && psd !=2  ">
                    <input type="text" name="mail" class="form-control" placeholder="Your Email *" v-model="supplier.email" />
                </div>
                <!-- end mail  -->
                <div class="form-group" v-if="check !=4 && check !=6 && check !=7 && psd !=1  ">
                    <input type="text" name="phone" class="form-control" placeholder="Your Phone Number *" v-model="supplier.phone" />
                </div>
                <!-- Supplier select  -->
                <a v-if="check==7 " class="a-link">Select Option Variable Employee Of Department</a>
                <select class="mdb-select md-form edit-w" v-model="supplier.user_id" v-if="check==7">
                    <option value="" disabled>Choose your option</option>
                    <option v-for="roleItem of dataUser" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
                </select>
                <!-- end supplier select  -->
                <div class="form-group">
                    <input type="submit" name="btnSubmit" class="btnContact" value="Save " />
                </div>

            </div>
        </div>
    </form>
</div>
</template>

<script>
import User from '../api/user'
import {
    mapActions
} from 'vuex'
export default {
    props: ['check', 'modal', 'cc','psd'],
    data() {
        return {
            supplier: {
                name: '',
                email: '',
                phone: '',
                address: '',
                user_id: ''
            },
            dataUser: null,

        }
    },
    methods: {
        ...mapActions('supplier', ['addSupplier','addSuItem']),
        ...mapActions('sales', ['addSales']),
        ...mapActions('partner', ['addPartner']),
        ...mapActions('typemachine', ['addTypeMachineItem', 'getType']),
        ...mapActions('user', ['addUser']),
        ...mapActions('department', ['addDepartment', 'getSupplier','addDeItem']),
        ...mapActions('service',['addSeItem']),
        ...mapActions('partner',['addPaItem']),
        
        showList() {
            this.$emit('toggle-list')
        },
        AddSupplierFrom(data) {
            if (this.check == 1) {
                this.addSuItem(data);
            } else if (this.check == 2) {
                this.addSales(data)
            } else if (this.check == 3) {
                this.addPartner(data)
            } else if (this.check == 4) {
                this.addTypeMachineItem(data);
            } else if (this.check == 5) {
                this.addUser(data);
            } else if (this.check == 7) {
                this.addDeItem(data);
            }else if (this.psd == 1) {
                this.addSeItem(data);
            }else if (this.psd == 2) {
                this.addPaItem(data);
            }
        },
        takeDataUser() {
            User.getAll().then((response) => {
                this.dataUser = response.data
            })
        }
    },
    created() {
        this.takeDataUser();

    }
}
</script>

<style scoped>
.contact-form form[data-v-23dbbeb5],
.contact-form form[data-v-6be7b2a8] {
    padding: 0 !important;
}

.title {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: crimson;
}

.contact-form {
    background: #fff;
    margin-bottom: 5%;
    width: 100%;
    border: 1px #c7c3c3 solid;
    height: auto;
    /* margin: 10px 50px 0 0; */
    padding: 10px 0px 100px 185px;
    box-sizing: border-box;
    box-shadow: 1px 1px 7px 2px #b5b3b3;
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
    padding-bottom: 10px;
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
