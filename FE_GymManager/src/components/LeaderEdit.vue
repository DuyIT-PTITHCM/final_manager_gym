<template>
<div>
    <form @submit.prevent="updateClient(passDevice.id,dataUpdate)">
        <div class="form-group">
            <label for="exampleFormControlInput1"><br>Department </label>
            <input disabled type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" v-model="passDevice.department.name">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input disabled type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" v-model="passDevice.name">
        </div>
            <div class="form-group">
            <label for="exampleFormControlInput1">Status Device</label>
            <input disabled type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" v-model="passDevice.status.name">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Price Buy</label>
            <input disabled type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" :value="formatPrice(passDevice.pricebuy) + '  VNĐ' ">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Type Machine</label>
            <input disabled type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" v-model="passDevice.typemachine.name">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Date Buy</label>
            <input disabled type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" :value="formatDate(passDevice.created_at)">
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1"> select status</label>
            <select id="exampleFormControlSelect1" class="mdb-select md-form" v-model="dataUpdate.status_id">
                <option value="" disabled selected>Choose your option</option>
                <option v-for="roleItem of dataStatus" :key="roleItem.id" :value="roleItem.id">{{roleItem.name}}</option>
            </select>
            <!-- end role select  -->
        </div>

        <div class="form-group">
            <input type="submit" name="btnSubmit" class="btnContact" value="Save " />
           
        </div>
       
    </form>
      <a class="a-link" @click="showList" >Go back</a>
</div>
</template>

<script>
import Status from '../api/StatusDevice'
import Client from '../api/client'
export default {
    props: ['passDevice'],
    data() {
        return {
            dataStatus: null,
            dataUpdate: {
                status_id: 1
            }
        }
    },
    methods: {
        takeDataStatus() {
            Status.getAll().then((response) => {
                this.dataStatus = response.data
            })
        },
        formatDate(date) {
            let d = new Date(date);
            return d.getDate() + '-' + d.getMonth() + '-' + d.getFullYear();
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        showList() {
            this.$emit('toggle-list')
        },
        updateClient(id,data){
            Client.updateClient(id,data).then(()=>{
                alert('update success')
                this.$emit('reload-page');
            })
            .catch(()=>{
                alert('update fail')
            })
        }
    },
    created() {
        this.takeDataStatus();
    }
}
</script>
