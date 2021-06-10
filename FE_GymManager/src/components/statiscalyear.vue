<template>
<div>
    <div class="row">
        <TableDetail v-if="check" :dataTable="dataPass" />
        <div id="admin" class="col s12">
            <div class="card material-table">
                <div class="table-header">
                    <span class="table-title">Service {{dataYear.service.name }} ----Date Detail {{dataYear.date}} ---- Total Cost Month {{formatPrice(dataYear.sum)}} VNĐ</span>
                </div>
                <table id="datatable">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Name</th>
                            <th>Detail Cost Service</th>
                            <th>Status Device</th>
                            <th>Department</th>
                            <th>Type Machine</th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="(item,index) of dataYear.listDevice" :key="item.id">
                            <td>{{index +1 }}</td>
                            <td>{{item.name}}</td>
                            <td @click="toggleModal(item.id)" class="custom">
                                <a class="a-link"> detail cost service and history</a>
                            </td>

                            <td>{{(item.status)?item.status.name:''}}</td>
                            <td>{{(item.department)?item.department.name:''}}</td>
                            <td>{{(item.typemachine)?item.typemachine.name:''}}</td>
                            <!-- <td>{{(item.supplier)?item.supplier.name:''}}</td> -->
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <router-link to="/service">
        <a href="">Go Back</a>
    </router-link>
</div>
</template>

<script>
import TableDetail from './TableDetail'
import Service from '../api/service'
export default {
    components: {
        TableDetail
    },
    data() {
        return {
            dataYear: null,
            price: 1,
            showModal: false,
            dataPass: {
                device_id: 7,
                service_id: 5

            },
            check: false
        }
    },
    methods: {
        takeDataYear() {
            let url = 'statisticalserviceyear/' + this.$route.params.id;
            Service.getStatiscalYear(url).then((response) => {
                this.dataYear = response.data
            })
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        toggleModal(id) {
            this.dataPass.device_id = id;
            this.dataPass.service_id = this.dataYear.service.id;
            this.check = !this.check;
        }
    },
    created() {
        this.takeDataYear();
    }

}
</script>
<style>
.a-link {
    /* color: blue !important; */
    /* font-style: italic; */
    text-decoration: none;
    font-size: 17px;
    font-style: normal;
    color: #c69696;
}
</style>