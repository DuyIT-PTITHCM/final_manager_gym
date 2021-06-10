import TypeMachine from "../../../api/typemachine"
export const getType= ({commit})=>{
    TypeMachine.getAll().then((response)=>{
        commit('SET_DATA_TYPEALL',response.data)
    })
}
export const  updateTypeMachine = ({commit},{id,data})=>{
    TypeMachine.update(id,data).then(()=>{
        commit('UPDATE_SUPPLIER',data);
    }).catch((error)=>{
        console.log(error)
    })
  
} 
export const addTypeMachine=({commit},data)=>{
    TypeMachine.store(data).then(()=>{
        commit('ADD_TO_LIST',data);
        alert("Add successful")
    })
    .catch(()=>{
        alert("Add failure")
    })
}

export const addTypeMachineItem=({commit},data)=>{
    TypeMachine.store(data).then(()=>{
        commit('ADD_TO_LIST_ALL',data);
        console.log(data)
        alert("Add successful")
    })
    .catch((error)=>{
        console.log(error)
        alert("Add failure")
    })
}
export const deleteSupplier= (({commit},id)=>{
    TypeMachine.destroy(id).then(()=>{
        commit('DELETE_ITEM',id);
    })
})
export const getByPage=(({commit},id)=>{
    TypeMachine.getPage(id).then((response)=>{
        commit('GET_PAGE',response.data);
    })
})
