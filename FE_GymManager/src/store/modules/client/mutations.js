export const SET_DATA_USER = (state,data)=>{
    state.userLogin = data;

}
export const UPDATE_USER =(state,data)=>{
    state.userLogin.id = data.id
    state.userLogin.name = data.name
    state.userLogin.phone = data.phone
    state.userLogin.image = data.image
}
export const SET_DATA_DEVICE = (state,data)=>{
    state.dataDevice = data;

}
export const findByName = (state, inputFind)=>{
    let a = state.dataDevice.devices;
    state.dataDevice.devices =  a.filter(element => element.name.indexOf(inputFind) >= 0);
    
}