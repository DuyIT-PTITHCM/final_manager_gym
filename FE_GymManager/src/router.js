import Login from './components/Login'
import Vue from 'vue'
import VueRouter from "vue-router";
import Header from './components/Header'
import Home from './components/Home'
import Supplier from './components/Supplier'
import Sales from './components/Sales'
import Partner from './components/Partner'
import TypeMachine from './components/TypeMachine'
import UploadImg from './components/UploadImg'
import User from './components/User'
import Device from './components/Device'
import Department from './components/Department'
import Service from './components/Service'
import Statiscal from './components/Statiscal'
import Statiscalyear from './components/statiscalyear'
import HomePage from './components/HomePage'
import FormService from './components/FormService'
import Cost from './components/StatiscalCostIn'
import CostOut from './components/StatiscalCostOut'
import DeviceToPurchasing from './components/DeviceToPurchasing'
import Staff from './components/Leader'
import Profile from './components/ProfileEdit'
import Destaff from './components/DeLeader'
import ChangePassword from './components/ChangePassword'
import DetailDeparment from './components/DeviceDepartment'
import DetailType from './components/TabeTypeDevice'
const routers = [{
        path: '/login',
        component: Login,
        name: 'login'
    },
    {
        path: '/header',
        component: Header,
        name: 'header',
        children: [{
                path: '/home',
                component: Home,
                name: 'home'
            },
            {
                path: '/supplier',
                component: Supplier,
                name: 'supplier'
            },
            {
                path: '/sales',
                component: Sales,
                name: 'sales'
            },
            {
                path: '/partner',
                component: Partner,
                name: 'partner'
            },
            {
                path: '/typemachine',
                component: TypeMachine,
                name: 'typemachine'
            },
            {
                path: '/user',
                component: User,
                name: 'user'
            },
            {
                path: '/device',
                component: Device,
                name: 'device'
            },
            {
                path: '/department',
                component: Department,
                name: 'department'
            },
            {
                path: '/service',
                component: Service,
                name: 'service'
            },
            {
                path: '/statiscal/:id',
                component: Statiscal,
                name: 'statiscal',
                props: true
            },
            {
                path: '/statiscalyear/:id',
                component: Statiscalyear,
                name: 'statiscalyear',
                props: true
            },
            {
                path: '/addpsd',
                component: FormService,
                name: 'psd',
                props: true
            },
            {
                path: '/cost',
                component: Cost,
                name: 'cost'
            },
            {
                path: '/costout',
                component: CostOut,
                name: 'costout'
            },
            {
                path: '/addpur',
                component: DeviceToPurchasing,
                name: 'addpur'
            },
            {
                path: '/detailDepartment/:id',
                component: DetailDeparment,
                name: 'detail_partment',
                props: true
            },
            {
                path: '/detailType/:id',
                component: DetailType,
                name: 'detail_type',
                props: true
            }

        ]
    },
    {
        path: '/uploadimg',
        component: UploadImg,
        name: 'uploadimg'
    }, {
        path: '/',
        component: HomePage,
        name: 'homepage'
    },
    {
        path: '/staff',
        component: Staff,
        name: 'staff',
        children: [{
                path: '/destaff',
                component: Destaff,
                name: 'destaff',
            },
            {
                path: '/change-password',
                component: ChangePassword,
                name: 'change-password',
            }
        ]
    },
    {
        path: '/profile',
        component: Profile,
        name: 'profile'
    }



]
Vue.use(VueRouter);
const router = new VueRouter({
    routes: routers,
    mode: 'history'
})
router.beforeEach((to, from, next) => {
    let excludePages = ['/login', '/'];
    let requireLogin = !excludePages.includes(to.path);
    let token = window.localStorage.getItem('token');
    if (requireLogin && !token) {
        next({ name: 'login' });
    } else {
        next();
    }

})

export default router;