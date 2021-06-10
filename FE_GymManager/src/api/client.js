import Api from './Api'
export default{
    get(){
        return Api.get('userlogin');
    },
    update(id,data){
        let url = 'editprofile/' +id;
        return Api.put(url,data);
    },
    getDevice(){
        return Api.get('huhu')
    },
    updateClient(id,data){
        let url = 'clientupdate/' +id;
        return Api.put(url,data);
    }
}