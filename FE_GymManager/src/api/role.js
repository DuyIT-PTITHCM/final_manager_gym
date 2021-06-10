import Api from './Api'
const END_POINT ='role';
export default{
    get(){
        return Api.get(END_POINT);
    }
}