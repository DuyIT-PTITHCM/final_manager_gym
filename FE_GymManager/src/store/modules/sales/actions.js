import Sales from "../../../api/sales"
export const getSupplier= ({commit})=>{
    Sales.get().then((response)=>{
        commit('SET_DATA_SUPPLIER',response.data)
    
    })
}
export const  updateSales = ({commit},{id,data})=>{
    Sales.update(id,data).then(()=>{
        commit('UPDATE_SUPPLIER',data);
    }).catch((error)=>{
        console.log(error)
    })
  
} 
export const addSales=({commit},data)=>{
    Sales.store(data).then(()=>{
        commit('ADD_TO_LIST',data);
        alert("Add successful")
    })
    .catch(()=>{
        alert("Add failure")
    })
}
export const deleteSupplier= (({commit},id)=>{
    Sales.destroy(id).then(()=>{
        commit('DELETE_ITEM',id);
    })
})
export const getByPage=(({commit},id)=>{
    Sales.getPage(id).then((response)=>{
        commit('GET_PAGE',response.data);
    })
})
