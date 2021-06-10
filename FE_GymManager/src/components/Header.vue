<template>
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" :class="{active:toggle}">
        <!-- them class active thi no se dau di  -->
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary" @click="handleToggle"></button>
        </div>
        <div class="img bg-wrap text-center py-4 ac">
            <div class="user-logo">
                <div class="img aa"></div>
                <h3>{{userLogin.name}}</h3>
            </div>
        </div>
        <ul class="list-unstyled components mb-5">
            <router-link to="/home" class="active">
                <li >
                    <a href="#"><span class="fa fa-home mr-3"></span> Home</a>
                </li>

            </router-link>
            <router-link to="/supplier" class="active">
                <li>
                    <a><span class="fa fa-bank mr-3"></span> Supplier management</a>
                </li>
            </router-link>
            <router-link to="/user" class="active">
                <li>
                    <a><span class="fa fa-american-sign-language-interpreting mr-3"></span> Employee management</a>
                </li>
            </router-link>
            <router-link to="/sales" class="active">
                <li>
                    <a><span class="fa fa-trophy mr-3"></span> Purchasing Management</a>
                </li>
            </router-link>
            <router-link to="/partner" class="active">
                <li>
                    <a><span class="fa fa-gift mr-3"></span> Partner Management</a>
                </li>
            </router-link>
            <router-link to="/typemachine" class="active">
                <li>
                    <a><span class="fa fa-legal mr-3"></span>Device Type Management</a>
                </li>
            </router-link>

            <router-link to="/department" class="active">
                <li>
                    <a><span class="fa fa-snowflake-o mr-3"></span> Department Management</a>
                </li>
            </router-link>
            <router-link to="/service" class="active">
                 <li>
                    <a href="#"><span class="fa fa-cog mr-3"></span> Service Management</a>
                </li>
            </router-link>
            <router-link to="/device" class="active">

                <li>
                    <a href="#"><span class="fa fa-cog mr-3"></span> Device Management</a>
                </li>
            </router-link>
            <router-link to="/cost" class="active">
            <li>
                <a href="#"><span class="fa fa-support mr-3"></span> Input Cost Statistics</a>
            </li>
            </router-link>
           <router-link to="/costout" class="active">
            <li>
                <a href="#"><span class="fa fa-support mr-3"></span> Output Cost Statistics</a>
            </li>
            </router-link>
            <li>
                <a @click="logout"><span class="fa fa-sign-out mr-3"></span> Sign Out</a>
            </li>
        </ul>
    </nav>
    <!-- end block  -->
    <div id="content" class="p-4 ">
        <router-view></router-view>
    </div>

</div>
</template>

<script>
export default {
    data() {
        return {
            toggle: false,
            userLogin:null
        }
    },
    methods: {
        handleToggle() {
            this.toggle = !this.toggle
        },
        takeUserLogin(){
           let a = window.localStorage.getItem('aloalo');
            this.userLogin = JSON.parse(a);
        },
        logout(){
            window.localStorage.removeItem('aloalo');
            window.localStorage.removeItem('token');
            this.$router.push('homepage')

        }
    },
    created(){
        this.takeUserLogin();
    }
}
</script>

<style>
a.active.router-link-active li {
    background: #2f89fc!important;
    /* color: #5a2222; */
}
a.active.router-link-active li a {
    color: black !important;
}
.aa {
    background-image: url('./../assets/logo1.jpg');
}

.ac {
    background-image: url('./../assets/bg_1.jpg');
}

.img {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}

.wrapper {
    width: 100%;
}

#sidebar {
    min-width: 300px;
    max-width: 300px;
    background: #32373d;
    color: #fff;
    -webkit-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
    position: relative;

}

#sidebar .h6 {
    color: #fff;
}

#sidebar.active {
    margin-left: -300px;

}

#sidebar.active .custom-menu {
    margin-right: -50px;
}

#sidebar.active .btn.btn-primary:before {
    content: "\f053";
    font-family: "FontAwesome";
    right: 2px !important;
}

#sidebar.active .btn.btn-primary:after {
    display: none;
}

#sidebar h1 {
    margin-bottom: 20px;
    font-weight: 700;
    font-size: 20px;
}

#sidebar h1 .logo {
    color: #fff;
    display: block;
    padding: 10px 30px;
    background: #2f89fc;
}

#sidebar ul.components {
    padding: 0;
}

#sidebar ul li {
    font-size: 16px;
}

#sidebar ul li>ul {
    margin-left: 10px;
}

#sidebar ul li>ul li {
    font-size: 14px;
}

#sidebar ul li a {
    padding: 15px 30px;
    display: block;
    color: rgba(255, 255, 255, 0.6);
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

#sidebar ul li a span.notif {
    position: relative;
}

#sidebar ul li a span.notif small {
    position: absolute;
    top: -3px;
    bottom: 0;
    right: -3px;
    width: 12px;
    height: 12px;
    content: '';
    background: red;
    border-radius: 50%;
    font-family: "Poppins", Arial, sans-serif;
    font-size: 8px;
}

#sidebar ul li a:hover {
    color: #fff;
    background: #2f89fc;
    border-bottom: 1px solid #2f89fc;
}

#sidebar ul li.active>a {
    background: transparent;
    color: #fff;
}

#sidebar ul li.active>a:hover {
    background: #2f89fc;
    border-bottom: 1px solid #2f89fc;
}

@media (max-width: 991.98px) {
    #sidebar {
        margin-left: -300px;
    }

    #sidebar.active {
        margin-left: 0;
    }

    #sidebar .custom-menu {
        margin-right: -60px !important;
        top: 10px !important;
    }
}

#sidebar .custom-menu {
    display: inline-block;
    position: absolute;
    top: 20px;
    right: 0;
    margin-right: -35px;
    -webkit-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s;
}

@media (prefers-reduced-motion: reduce) {
    #sidebar .custom-menu {
        -webkit-transition: none;
        -o-transition: none;
        transition: none;
    }
}

#sidebar .custom-menu .btn.btn-primary {
    background: #2f89fc;
    border-color: transparent;
    position: relative;
    color: #000;
    width: 30px;
    height: 30px;
}

#sidebar .custom-menu .btn.btn-primary:after,
#sidebar .custom-menu .btn.btn-primary:before {
    position: absolute;
    top: 2px;
    left: 0;
    right: 0;
    bottom: 0;
    font-family: "FontAwesome";
    color: #fff;
}

#sidebar .custom-menu .btn.btn-primary:after {
    content: "\f054";
    left: 2px;
}

.bg-wrap {
    width: 100%;
    position: relative;
    z-index: 0;
}

.bg-wrap:after {
    z-index: -1;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    content: '';
    background: #000;
    opacity: .3;
}

.bg-wrap .user-logo .img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto;
    margin-bottom: 10px;
}

.bg-wrap .user-logo h3 {
    color: #fff;
    font-size: 18px;
}

a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 0;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
}

@media (max-width: 991.98px) {
    #sidebarCollapse span {
        display: none;
    }
}

#content {
    width: 100%;
    padding: 0;
    min-height: 100vh;
    -webkit-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}

.grey-bg {
    background-color: #F5F7FA;
}
</style>
