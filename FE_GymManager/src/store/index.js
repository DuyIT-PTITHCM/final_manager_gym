import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)


import status from './modules/status'
import login from './modules/login'
import supplier from './modules/supplier'
import sales from './modules/sales'
import partner from './modules/partner'
import typemachine from './modules/typemachine'
import user from './modules/user'
import department from './modules/department'
import device from './modules/device'
import service from './modules/service'
import cost from './modules/cost'
import client from './modules/client'
const storeData = {
    modules:{
        login,
        status,
        supplier,
        sales,
        partner,
        typemachine,
        user,
        department,
        device,
        service,
        cost,
        client
    }
    
}

const store = new Vuex.Store(storeData)

export default store