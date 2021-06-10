<template>
<div class="row">
    <div id="admin" class="col s12">
        <div class="card material-table">
            <div class="table-header">
                <span class="table-title"> detail cost service and history</span>
            </div>
            <table id="datatable">
                <thead>
                    <tr>
                        <th>Count</th>
                        <th>Name</th>
                        <th>Price Service</th>
                        <th>Date Service</th>
                        <th>Department</th>
                        <th>Date End Service</th>

                    </tr>
                </thead>
                <tbody>

                    <tr v-for="(item,index) of dataList.listDevice" :key="item.id">
                        <td>{{index +1 }}</td>
                        <td>{{item.name}}</td>
                        <td >
                            {{formatPrice(item.price)}} VNĐ

                        <td>{{item.date}}</td>
                        <td>{{(item.department)?item.department.name:''}}</td>
                        <td>{{(item.enddate)?formatDate(item.enddate):'Không Có Nhá'}}</td>
                        <!-- <td>{{(item.supplier)?item.supplier.name:''}}</td> -->
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
</template>

<script>
import Service from '../api/service'
export default {
    props: ['dataTable'],
    data() {
        return {
            isShow: false,
            dataList: null
        }
    },
    methods: {
        takeDataTable() {
            Service.getDetailService(this.dataTable).then((response) => {
                this.dataList = response.data
               
            })
        

        },
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        formatDate(date){
            let d = new Date(date);
            return d.getDate() +'-'+ d.getMonth() +'-'+d.getFullYear();
        }
    },
    created() {
        this.takeDataTable();
    }

}
</script>
<style scoped>
.table-title {
    background: #ce1350;
}
</style>