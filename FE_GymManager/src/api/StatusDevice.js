import Api from './Api'
const END_POINT ='status';
export default{
    get(){
        return Api.get(END_POINT);
    },
    show(id){
        return Api.get(`${END_POINT}/${id}`);
    },
    store(data){
        return Api.post(END_POINT,data);
    },
    update(id,data){
        return Api.put(`${END_POINT}/${id}`,data)
    },
    destroy(id){
        return Api.delete(`${END_POINT}/${id}`);
    },
    getAll(){
        return Api.get('allstatus');
    }
}