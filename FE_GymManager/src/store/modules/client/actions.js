import Client from "../../../api/client"
export const getUserLogin= ({commit})=>{
    Client.get().then((response)=>{
        commit('SET_DATA_USER',response.data)
    
    })
}

export const  updateUserLogin = ({commit},{id,data})=>{
    Client.update(id,data).then(()=>{
        commit('UPDATE_USER',data);
    }).catch((error)=>{
        console.log(error)
    })
  
} 

export const getDataDevice= ({commit})=>{
    Client.getDevice().then((response)=>{
        commit('SET_DATA_DEVICE',response.data)
    
    })
}