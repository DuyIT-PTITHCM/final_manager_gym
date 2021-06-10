import StatusDevice from "../../../api/StatusDevice"


export const getStatus= ({commit})=>{
    StatusDevice.get().then((response)=>{
        commit('SET_STATUSES',response.data)
    })
}