import Cost from "../../../api/CostStatiscalIn"
export const getCostIn= ({commit})=>{
    Cost.getIn().then((response)=>{
        commit('SET_DATA_COST_IN',response.data)
    
    })
}
export const getCostOut= ({commit})=>{
    Cost.getOut().then((response)=>{
        commit('SET_DATA_COST_OUT',response.data)
    
    })
}