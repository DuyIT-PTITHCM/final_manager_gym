import Api from './Api'
const END_POINT = 'user';
export default {
    get() {
        return Api.get(END_POINT);
    },
    show(id) {
        return Api.get(END_POINT, id);
    },
    store(data) {
        return Api.post('register', data);
    },
    async update(id, data) {
        return await Api.put(`${END_POINT}/${id}`, data)
    },
    destroy(id) {
        return Api.delete(`${END_POINT}/${id}`);
    },
    getPage(id) {
        let url = END_POINT + '?page=' + id
        return Api.get(url);
    },
    getAll() {
        return Api.get('alluser');
    },
    changePassword(payload) {
        return Api.post('change-password', payload);
    }
}