<template>
<div class="container bootstrap snippets bootdey">
    <h1 class="text-primary"><span class="glyphicon glyphicon-user"></span>Edit Profile</h1>
    <hr>
    <div class="row">
        <!-- left column -->
        <div class="col-md-3">
            <div class="text-center">
                <img :src="userLogin.image" class="uploading-image" />
            </div>
        </div>

        <!-- edit form column -->
        <div class="col-md-9 personal-info">
            <h3>Change Password</h3>

            <form class="form-horizontal" role="form" @submit.prevent="changePassword()">
                <div class="form-group">
                    <label class="col-lg-3 control-label"> old password :</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="password" placeholder="old password" v-model="dataChangePass.old_password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"> new password </label>
                    <div class="col-lg-8">
                        <input class="form-control" type="password" placeholder="new password" v-model="dataChangePass.new_password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">repeat password:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="password" v-model="dataChangePass.repeat_password" placeholder="repaet pasword">
                    </div>
                </div>
               <button type="submit" class="btn btn-success CC">SAVE</button>
            </form>
        </div>
    </div>
</div>
</template>


<script>
import { mapActions, mapState } from 'vuex'
import userApi from '../api/user'
export default {
    data(){
        return {
            dataChangePass :{
                'old_password':null,
                'new_password':null,
                'repeat_password':null
            }
        }
    },
    computed: {
        ...mapState({
            userLogin :state =>state.client.userLogin
        })
    },
    methods: {
         ...mapActions('client', ['getUserLogin']),
            changePassword(){
                const {new_password ,repeat_password } = this.dataChangePass
                if(new_password == repeat_password){
                    userApi.changePassword(this.dataChangePass).then((res)=>{
                        if(!res.data.error){
                            alert('change password success')
                            this.$router.push({ path: 'destaff' })
                        }else{
                            alert('old password not correct')
                        }
                    }).catch(()=>{
                        alert('change password faild')
                    })
                }else{
                    alert('new password not same repeat password')
                }
            }
    },
    created(){
        this.getUserLogin();
    }
}
</script>
<style scoped>
button.btn.btn-success.CC {
    width: 64%;
    margin-left: 13px;
}
</style>

