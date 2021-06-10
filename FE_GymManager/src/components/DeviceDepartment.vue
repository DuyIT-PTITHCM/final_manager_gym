<template>
  <div>
    <div class="table-title">
      <div class="row">
        <div class="col-sm-12" >
          <h2 class="cc">List Devices  Of {{nameRoom.name}}</h2>
        </div>
      </div>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th>TypeMachine</th>
          <th>Status</th>
          <th>Department</th>
          <th>Supplier</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item of deviceById" :key="item.id">
          <td></td>
          <td>{{ item.name }}</td>
          <td>{{ item.typemachine ? item.typemachine.name : "Empty" }}</td>
          <td>{{ item.status ? item.status.name : "Empty" }}</td>
          <td>{{ item.department ? item.department.name : "Empty" }}</td>
          <td>{{ item.supplier ? item.supplier.name : "Empty" }}</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import department from "../api/department";
export default {
  data() {
    return {
      deviceById: null,
      nameRoom:null
    };
  },
  methods: {
    getDevivceByDepartment() {
      let id = this.$route.params.id;
      department
        .show(id)
        .then((response) => {
          this.deviceById = response.data.devices;
          this.nameRoom = response.data
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getDevivceByDepartment();
  },
};
</script>
<style>
.cc{
  text-align: center!important;
  margin: 0 auto;
}
</style>