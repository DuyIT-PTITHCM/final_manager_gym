<template>
<div class="container bootstrap snippets bootdey">
    <h1 class="text-primary"><span class="glyphicon glyphicon-user"></span>Edit Profile</h1>
    <hr>
    <div class="row">
        <!-- left column -->
        <div class="col-md-3">
            <div class="text-center">
                <img :src="userLogin.image" class="uploading-image" />
                <h6>Upload a different photo...</h6>

                <input type="file" accept="image/jpeg" @change=uploadImage>
            </div>
        </div>

        <!-- edit form column -->
        <div class="col-md-9 personal-info">
            <div class="alert alert-info alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a>
                <i class="fa fa-coffee"></i>
            </div>
            <h3>Personal info</h3>

            <form class="form-horizontal" role="form" @submit.prevent="editProfile()">
                <div class="form-group">
                    <label class="col-lg-3 control-label"> name:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" placeholder="name" v-model="userLogin.name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"> phone </label>
                    <div class="col-lg-8">
                        <input class="form-control" type="number" placeholder="edit phone" v-model="userLogin.phone">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" v-model="userLogin.email" disabled>
                    </div>
                </div>
                <input type="submit" value="save">
            </form>
        </div>
    </div>
</div>
</template>


<script>
import { mapActions, mapState } from 'vuex'
import User from '../api/user'
export default {
    computed: {
        ...mapState({
            userLogin :state =>state.client.userLogin
        })
    },
    methods: {
         ...mapActions('client', ['getUserLogin']),
         uploadImage(e){
                const image = e.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.userLogin.image = e.target.result;
                };
            },
            editProfile(){
                let id = this.userLogin.id;
                let data = this.userLogin
                console.log(data)
                User.update(id,data).then(()=>{
                    alert('Update Success')
                    this.$router.push('destaff')
                })
                .catch(()=>{
                    alert('Update Fail image file is too large')
                })
            }
    },
    created(){
        this.getUserLogin();
    }
}
</script>

