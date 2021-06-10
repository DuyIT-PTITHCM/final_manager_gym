export const sumIn = (state)=>{
    return Object.values(state.dataList0).reduce((t, {pricebuy}) => t + pricebuy, 0)
}
export const sumOut = (state)=>{
    return Object.values(state.dataList1).reduce((t, {pricesales}) => t + pricesales, 0)
}