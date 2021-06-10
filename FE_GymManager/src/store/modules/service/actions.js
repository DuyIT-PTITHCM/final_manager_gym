import Service from "../../../api/service"
export const getSupplier= ({commit})=>{
    Service.get().then((response)=>{
        commit('SET_DATA_SUPPLIER',response.data)
    
    })
}
export const  update = ({commit},{id,data})=>{
    Service.update(id,data).then(()=>{
        commit('UPDATE_SUPPLIER',data);
    }).catch((error)=>{
        console.log(error)
    })
  
} 
export const addService=({commit},data)=>{
    Service.store(data).then(()=>{
        console.log(data)
        commit('ADD_TO_LIST',data);
        alert("Add successful")
    })
    .catch(()=>{
        alert("Add failure")
    })
}
export const deleteSupplier= (({commit},id)=>{
    Service.destroy(id).then(()=>{
        commit('DELETE_ITEM',id);
    })
})
export const getByPage=(({commit},id)=>{
    Service.getPage(id).then((response)=>{
        commit('GET_PAGE',response.data);
    })
})

export const getSe= ({commit})=>{
    Service.getAll().then((response)=>{
        commit('SET_DATA_TYPEALL',response.data)
    })
}
export const addSeItem=({commit},data)=>{
    Service.store(data).then(()=>{
        commit('ADD_TO_LIST_ALL',data);
        alert("Add successful")
    })
    .catch((error)=>{
        console.log(error)
        alert("Add failure")
    })
}

