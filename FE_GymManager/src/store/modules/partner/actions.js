import Partner from "../../../api/partner"
export const getSupplier= ({commit})=>{
    Partner.get().then((response)=>{
        commit('SET_DATA_SUPPLIER',response.data)
    
    })
}
export const  editPartner = ({commit},{id,data})=>{
    Partner.update(id,data).then(()=>{
        commit('UPDATE_SUPPLIER',data);
    }).catch((error)=>{
        console.log(error)
    })
  
} 
export const addPartner=({commit},data)=>{
    Partner.store(data).then(()=>{
        commit('ADD_TO_LIST',data);
        alert("Add successful")
    })
    .catch(()=>{
        alert("Add failure")
    })
}
export const deleteSupplier= (({commit},id)=>{
    Partner.destroy(id).then(()=>{
        commit('DELETE_ITEM',id);
    })
})
export const getByPage=(({commit},id)=>{
    Partner.getPage(id).then((response)=>{
        commit('GET_PAGE',response.data);
    })
})

export const getPa= ({commit})=>{
    Partner.getAll().then((response)=>{
        commit('SET_DATA_TYPEALL',response.data)
    })
}
export const addPaItem=({commit},data)=>{
    Partner.store(data).then(()=>{
        commit('ADD_TO_LIST_ALL',data);
        alert("Add successful")
    })
    .catch((error)=>{
        console.log(error)
        alert("Add failure")
    })
}
