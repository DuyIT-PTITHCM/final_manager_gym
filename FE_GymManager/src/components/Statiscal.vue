<template>
<div>
    <div class="row">
        <TableDetail v-if="check" :dataTable="dataPass" />
        <div id="admin" class="col s12">
            <div class="card material-table">
                <div class="table-header">
                    <span class="table-title">Service {{dataMonth.service.name }} ----Date Detail {{dataMonth.date}} ---- Total Cost Month {{formatPrice(dataMonth.sum)}} VNĐ</span>
                </div>
                <table id="datatable">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Name</th>
                            <th>Detail Cost Service</th>
                            <th>Status</th>
                            <th>Department</th>
                            <th>Type</th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="(item,index) of dataMonth.listDevice" :key="item.id">
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
            dataMonth: null,
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
        takeDataMonth() {
            let url = 'statisticalservicemonth/' + this.$route.params.id;
            Service.getStatiscalMonth(url).then((response) => {
                this.dataMonth = response.data
            })
        },
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
            this.dataPass.service_id = this.dataMonth.service.id;
            this.check = !this.check;
        }
    },
    created() {
        this.takeDataMonth();
    }

}
</script>

<style>
.a-link {
    color: blue !important;
    font-style: italic;
}

.table-bg-red {
    background: chartreuse !important;
}

div.material-table {
    padding: 0;
}

div.material-table .hiddensearch {
    padding: 0 14px 0 24px;
    border-bottom: solid 1px #DDDDDD;
    display: none;
}

div.material-table .hiddensearch input {
    margin: 0;
    border: transparent 0 !important;
    height: 48px;
    color: rgba(0, 0, 0, .84);
}

div.material-table .hiddensearch input:active {
    border: transparent 0 !important;
}

div.material-table table {
    table-layout: fixed;
}

div.material-table .table-header {
    height: 64px;
    padding-left: 24px;
    padding-right: 14px;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    display: flex;
    -webkit-display: flex;
    border-bottom: solid 1px #DDDDDD;
}

div.material-table .table-header .actions {
    display: -webkit-flex;
    margin-left: auto;
}

div.material-table .table-header .btn-flat {
    min-width: 36px;
    padding: 0 8px;
}

div.material-table .table-header input {
    margin: 0;
    height: auto;
}

div.material-table .table-header i {
    color: rgba(0, 0, 0, 0.54);
    font-size: 24px;
}

div.material-table .table-footer {
    height: 56px;
    padding-left: 24px;
    padding-right: 14px;
    display: -webkit-flex;
    display: flex;
    -webkit-flex-direction: row;
    flex-direction: row;
    -webkit-justify-content: flex-end;
    justify-content: flex-end;
    -webkit-align-items: center;
    align-items: center;
    font-size: 12px !important;
    color: rgba(0, 0, 0, 0.54);
}

div.material-table .table-footer .dataTables_length {
    display: -webkit-flex;
    display: flex;
}

div.material-table .table-footer label {
    font-size: 12px;
    color: rgba(0, 0, 0, 0.54);
    display: -webkit-flex;
    display: flex;
}

div.material-table .table-footer .select-wrapper {
    display: -webkit-flex;
    display: flex;

}

div.material-table .table-footer .dataTables_info,
div.material-table .table-footer .dataTables_length {
    margin-right: 32px;
}

div.material-table .table-footer .material-pagination {
    display: flex;
    -webkit-display: flex;
    margin: 0;
}

div.material-table .table-footer .material-pagination li:first-child {
    margin-right: 24px;
}

div.material-table .table-footer .material-pagination li a {
    color: rgba(0, 0, 0, 0.54);
}

div.material-table .table-footer .select-wrapper input.select-dropdown {
    margin: 0;
    border-bottom: none;
    height: auto;
    line-height: normal;
    font-size: 12px;
    width: 40px;
    text-align: right;
}

div.material-table .table-footer select {
    background-color: transparent;
    width: auto;
    padding: 0;
    border: 0;
    border-radius: 0;
    height: auto;
    margin-left: 20px;
}

div.material-table .table-title {
    width: 100%;
    font-size: 20px;
    color: #000;
    min-width: 104%;
    margin: 9px -24px 8px;
}

div.material-table table tr td {
    padding: 0 0 0 56px;
    height: 48px;
    font-size: 13px;
    color: rgba(0, 0, 0, 0.87);
    border-bottom: solid 1px #DDDDDD;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

div.material-table table tr td a {
    color: inherit;
}

div.material-table table tr td a i {
    font-size: 18px;
    color: rgba(0, 0, 0, 0.54);
}

div.material-table table tr {
    font-size: 12px;
}

div.material-table table th {
    font-size: 12px;
    font-weight: 500;
    color: #757575;
    cursor: pointer;
    white-space: nowrap;
    padding: 0;
    height: 56px;
    padding-left: 56px;
    vertical-align: middle;
    outline: none !important;
}

div.material-table table th.sorting_asc,
div.material-table table th.sorting_desc {
    color: rgba(0, 0, 0, 0.87);
}

div.material-table table th.sorting:after,
div.material-table table th.sorting_asc:after,
div.material-table table th.sorting_desc:after {
    font-family: 'Material Icons';
    font-weight: normal;
    font-style: normal;
    font-size: 16px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    word-wrap: normal;

    -webkit-font-smoothing: antialiased;
    content: "arrow_back";

    display: none;
    vertical-align: middle;
}

div.material-table table th.sorting:hover:after,
div.material-table table th.sorting_asc:after,
div.material-table table th.sorting_desc:after {
    display: inline-block;
}

div.material-table table th.sorting_desc:after {
    content: "arrow_forward";
}

div.material-table table tbody tr:hover {
    background-color: #EEE;
}

div.material-table table th:first-child,
div.material-table table td:first-child {
    padding: 0 0 0 24px;
}

div.material-table table th:last-child,
div.material-table table td:last-child {
    padding: 0 14px 0 0;
}
</style>
