<template>
<div class="row">
    <div id="admin" class="col s12">
        <div class="card material-table">
            <div class="table-header">
                <span class="table-title">Statistics of Devices Purchased During the Year</span>
            </div>
            <table id="datatable">
                <thead>
                    <tr>
                        <th>Supplier </th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Department</th>
                        <th>Date Buy</th>
                        <th>Price Buy</th>

                    </tr>
                </thead>
                <tbody>

                    <tr v-for="item of data1" :key="item.id">
                        <td>{{(item.supplier)?item.supplier.name:'Empty'}}</td>
                        <td>{{item.name}}</td>
                        <td>{{(item.typemachine)?item.typemachine.name:'Empty'}}</td>
                        <td>{{(item.department)?item.department.name:'Empty'}}</td>
                        <td>{{(item.created_at)?formatDate(item.created_at):'Empty'}}</td>
                        <td>
                            {{formatPrice(item.pricebuy)}} VNĐ

                        </td>
                    </tr>

                </tbody>

            </table>
        </div>
        <h4> Total Input Costs During the Year {{ (new Date()).getFullYear() }} : {{formatPrice(sumIn)}} VNĐ</h4>

    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapGetters,
    mapState
} from 'vuex'
export default {
    computed: {
        ...mapState({
            data1: state => state.cost.dataList0
        }),
        ...mapGetters('cost', ['sumIn'])
    },
    methods: {
        ...mapActions('cost', ['getCostIn']),
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        formatDate(date) {
            let d = new Date(date);
            return d.getDate() + '-' + d.getMonth() + '-' + d.getFullYear();
        }
    },
    created() {
        // this.takeDataCostInYear();
        this.getCostIn();
    }
}
</script>
