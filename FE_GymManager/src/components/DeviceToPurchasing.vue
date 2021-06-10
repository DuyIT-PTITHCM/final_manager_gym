
<template>
<div>
    <!-- device  -->
    <div class=" contact-form form-post">

        <form @submit.prevent="addToPurchasing(device.id,device)" method="post">
            <router-link to="/costout">
                <a class="add_service">
                   Sold List
                </a>

            </router-link>
            <p class="title">Add New </p>
            <div class="row">
                <div class="col-md-12">
                    <a class="a-link">Select Device For Sale</a>
                    <br>
                    <select class="mdb-select md-form edit-m " v-model="device.id">
                        <option value="" disabled selected>Choose your option</option>
                        <option v-for="item of dataDevice" :key="item.id" :value="item.id">{{item.name}}</option>
                    </select>
                    <br>
                    <!-- end device  -->
                    <br>
                    <!-- cost service  -->
                    <a class="a-link">Enter the selling price</a>
                    <div class="form-group ">
                        <input type="text" name="pricesales" class="form-control" placeholder="Cost pricesales *" v-model="device.pricesales" />
                    </div>
                    <!-- end cost service  -->

                    <!-- begin pủchasing  -->
                    <a class="a-link">Choose the Purchaser</a>
                    <br>
                    <select class="mdb-select md-form edit-m " v-model="device.purchasing_id">
                        <option value="" disabled selected>Choose your option</option>
                        <option v-for="item of dataPurchasing" :key="item.id" :value="item.id">{{item.name}}</option>
                    </select>
                    <br>
                    <!-- end purchasing  -->
                    <br>
                    <div class="form-group w-300">
                        <input type="submit" name="btnSubmit" class="btnContact" value="Save " />
                    </div>
                </div>

            </div>

        </form>
        <router-link to="/sales">
            <a class="add_service1">
                Go Back
            </a>

        </router-link>
        <br>

    </div>
</div>
</template>

<script>
import Purchasing from '../api/sales'
import Device from '../api/device'
import Sales from '../api/device'
export default {
    data() {
        return {
            dataDevice: null,
            dataPurchasing: null,
            device: {
                id: null,
                pricesales: null,
                purchasing_id: null
            }
        }
    },
    methods: {
        takeDataDevice() {
            Device.getAll().then((response) => {
                this.dataDevice = response.data
            })
        },
        takeDataPurchasing() {
            Purchasing.getAll().then((response) => {
                this.dataPurchasing = response.data
            })
        },
        addToPurchasing(id, data) {
            console.log(data)
            Sales.update(id, data).then(() => {
                    alert('Successful sale')
                    this.$router.push('/costout');
                })
                .catch(() => {
                    alert('Selling failed')
                })
        }
    },
    created() {
        this.takeDataDevice();
        this.takeDataPurchasing();
    }
}
</script>

<style>
.w-300 {
    width: 400px;
    height: 50px;
}

.edit-m {
    margin-left: 0;
    display: block;
    width: 100%;
    margin-bottom: 20px;
}
a.add_service1 {
    padding: 24px;
    /* width: 77px; */
    height: 50px;
    /* background: aqua; */
    cursor: pointer;
}
</style>