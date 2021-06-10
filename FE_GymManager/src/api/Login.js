import Api from './Api'
const END_POINT ='login';
export default{
    login(data){
        return Api.post(END_POINT,data);
    }
}