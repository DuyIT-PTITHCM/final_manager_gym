import Supplier from "../../../api/Supplier"
export const getSupplier= ({commit})=>{
    Supplier.get().then((response)=>{
        commit('SET_DATA_SUPPLIER',response.data)
    
    })
}
export const  update = ({commit},{id,data})=>{
    Supplier.update(id,data).then(()=>{
        commit('UPDATE_SUPPLIER',data);
    }).catch((error)=>{
        console.log(error)
    })
  
} 
export const addSupplier=({commit},data)=>{
    Supplier.store(data).then(()=>{
        commit('ADD_TO_LIST',data);
        alert("Add successful")
    })
    .catch(()=>{
        alert("Add failure")
    })
}
export const deleteSupplier= (({commit},id)=>{
    Supplier.destroy(id).then(()=>{
        commit('DELETE_ITEM',id);
    })
})
export const getByPage=(({commit},id)=>{
    Supplier.getPage(id).then((response)=>{
        commit('GET_PAGE',response.data);
    })
})

export const getSu= ({commit})=>{
    Supplier.getAll().then((response)=>{
        commit('SET_DATA_TYPEALL',response.data)
    })
}
export const addSuItem=({commit},data)=>{
    Supplier.store(data).then(()=>{
        commit('ADD_TO_LIST_ALL',data);
        alert("Add successful")
    })
    .catch((error)=>{
        console.log(error)
        alert("Add failure")
    })
}

