
import Login from '../../../api/Login'

export const LoginNow = ({commit} , data)=>{
    Login.login(data).then(function (response){
        window.localStorage.removeItem('token');
        window.localStorage.removeItem('aloalo');
        window.localStorage.setItem('token',response.data.token)
        window.localStorage.setItem('aloalo',JSON.stringify(response.data))
        commit('ADD_USER_LOGIN',response.data);
    }).catch(()=>{
        commit('LOGIN_FAIL');
    })
    
}