export const ADD_USER_LOGIN = (state,data)=>{
    state.userLogin  = data
}
export const LOGIN_FAIL = (state)=>{
    state.checkError = !state.checkError
}