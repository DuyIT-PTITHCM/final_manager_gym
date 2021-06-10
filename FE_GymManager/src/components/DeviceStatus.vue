<template>
<div>
    <h3 class="list-device">Danh Sách Thiết Bị Phòng Gym </h3>
    <div class="table100 ver3 m-b-110">
        <div class="table100-head">
            <table>
                <thead>
                    <tr class="row100 head">
                        <th class="cell100 column1">Name</th>
                        <th class="cell100 column2">Type</th>
                        <th class="cell100 column3">Status</th>
                        <th class="cell100 column4">Department</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="table100-body js-pscroll">
            <table>
                <tbody>
                    <tr class="row100 body">
                        <td class="cell100 column1">Like a butterfly</td>
                        <td class="cell100 column2 ">Boxing</td>
                        <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                        <td class="cell100 column4">Aaron Chapman</td>
                    </tr>
                    <tr class="row100 body">
                        <td class="cell100 column1">Like a butterfly</td>
                        <td class="cell100 column2 ">Boxing</td>
                        <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                        <td class="cell100 column4">Aaron Chapman</td>
                    </tr>
                    <tr class="row100 body">
                        <td class="cell100 column1">Like a butterfly</td>
                        <td class="cell100 column2 ">Boxing</td>
                        <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                        <td class="cell100 column4">Aaron Chapman</td>
                    </tr>
                    <tr class="row100 body">
                        <td class="cell100 column1">Like a butterfly</td>
                        <td class="cell100 column2 ">Boxing</td>
                        <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                        <td class="cell100 column4">Aaron Chapman</td>
                    </tr>
                    <tr class="row100 body">
                        <td class="cell100 column1">Like a butterfly</td>
                        <td class="cell100 column2 ">Boxing</td>
                        <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                        <td class="cell100 column4">Aaron Chapman</td>
                    </tr>
                    <tr class="row100 body">
                        <td class="cell100 column1">Like a butterfly</td>
                        <td class="cell100 column2 ">Boxing</td>
                        <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                        <td class="cell100 column4">Aaron Chapman</td>
                    </tr>
                   <tr class="row100 body">
                        <td class="cell100 column1">Like a butterfly</td>
                        <td class="cell100 column2 ">Boxing</td>
                        <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                        <td class="cell100 column4">Aaron Chapman</td>
                    </tr>
                    <tr class="row100 body">
                        <td class="cell100 column1">Like a butterfly</td>
                        <td class="cell100 column2 ">Boxing</td>
                        <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                        <td class="cell100 column4">Aaron Chapman</td>
                    </tr>
                    <tr class="row100 body">
                        <td class="cell100 column1">Like a butterfly</td>
                        <td class="cell100 column2 ">Boxing</td>
                        <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                        <td class="cell100 column4">Aaron Chapman</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props:['id']
}
</script>

<style scoped>
.list-device {
    margin: 70px 0 0 0;
    width: 100%;
    background: olive;
    text-align: center;
    border-radius: 2px;
}

.table100 {
    margin: 30px 0;
}

.table100 .ps__rail-y {
    width: 9px;
    background-color: transparent;
    opacity: 1 !important;
    right: 5px;
}

.table100 .ps__rail-y::before {
    content: "";
    display: block;
    position: absolute;
    background-color: #ebebeb;
    border-radius: 5px;
    width: 100%;
    height: calc(100% - 30px);
    left: 0;
    top: 15px;
}

.table100 .ps__rail-y .ps__thumb-y {
    width: 100%;
    right: 0;
    background-color: transparent;
    opacity: 1 !important;
}

.table100 .ps__rail-y .ps__thumb-y::before {
    content: "";
    display: block;
    position: absolute;
    background-color: #cccccc;
    border-radius: 5px;
    width: 100%;
    height: calc(100% - 30px);
    left: 0;
    top: 15px;
}

.limiter {
    width: 1366px;
    margin: 0 auto;
}

.container-table100 {
    width: 100%;
    min-height: 100vh;
    background: #fff;

    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    padding: 33px 30px;
}

.wrap-table100 {
    width: 1170px;
}

/*//////////////////////////////////////////////////////////////////
[ Table ]*/
.table100 {
    background-color: #fff;
}

table {
    width: 100%;
}

th,
td {
    font-weight: unset;
    padding-right: 10px;
}

.column1 {
    width: 33%;
    padding-left: 40px;
}

.column2 {
    width: 13%;
}

.column3 {
    width: 22%;
}

.column4 {
    width: 19%;
}

.column5 {
    width: 13%;
}

.table100-head th {
    padding-top: 18px;
    padding-bottom: 18px;
}

.table100-body td {
    padding-top: 16px;
    padding-bottom: 16px;
}

/*==================================================================
[ Fix header ]*/
.table100 {
    position: relative;
    padding-top: 60px;
}

.table100-head {
    position: absolute;
    width: 100%;
    top: 0;
    left: 0;
}

.table100-body {
    max-height: 585px;
    overflow: auto;
}

/*==================================================================
[ Ver3 ]*/

.table100.ver3 {
    background-color: #393939;
}

.table100.ver3 th {
    font-family: Lato-Bold;
    font-size: 15px;
    color: #00ad5f;
    line-height: 1.4;
    text-transform: uppercase;
    background-color: #393939;
}

.table100.ver3 td {
    font-family: Lato-Regular;
    font-size: 15px;
    color: #808080;
    line-height: 1.4;
    background-color: #222222;
}

/*---------------------------------------------*/

.table100.ver3 {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    -webkit-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    -o-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    -ms-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
}

.table100.ver3 .ps__rail-y {
    right: 5px;
}

.table100.ver3 .ps__rail-y::before {
    background-color: #4e4e4e;
}

.table100.ver3 .ps__rail-y .ps__thumb-y::before {
    background-color: #00ad5f;
}
</style>
