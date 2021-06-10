<template>
  <div class="row">
    <div id="admin" class="col s12">
      <div class="card material-table">
        <div class="table-header">
          <span class="table-title">{{ nameType }}</span>
        </div>
        <table id="datatable">
          <thead>
            <tr>
              <th>Purchasing</th>
              <th>Name</th>
              <th>Date Buy</th>
              <th>Department</th>
              <th>Price Buy</th>
              <th>Price Sales</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item of listDevice" :key="item.id">
              <td>{{ item.purchasing ? item.purchasing.name : "Empty" }}</td>
              <td>{{ item.name }}</td>
              <td>
                {{ item.created_at ? formatDate(item.created_at) : "Empty" }}
              </td>
              <td>{{ item.department ? item.department.name : "Empty" }}</td>
              <td>{{ formatPrice(item.pricebuy) }} VNĐ</td>
              <td>{{ formatPrice(item.pricesales) }} VNĐ</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import DeviceByType from "../api/typemachine";
export default {
  data() {
    return {
      listDevice: null,
      nameType: null,
    };
  },
  methods: {
    formatPrice(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    formatDate(date) {
      let d = new Date(date);
      return d.getDate() + "-" + d.getMonth() + "-" + d.getFullYear();
    },
    takeDeviceByTypeId() {
      let id = this.$route.params.id;
      DeviceByType.show(id)
        .then((response) => {
          this.listDevice = response.data.devices;
          this.nameType = response.data.name;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.takeDeviceByTypeId();
  },
};
</script>
