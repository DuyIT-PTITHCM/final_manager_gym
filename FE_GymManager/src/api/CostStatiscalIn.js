import Api from './Api'

export default{
    getIn(){
        return Api.get('statisticalbuyyear');
    },
    getOut(){
        return Api.get('statisticalsalesyear');
    }
}