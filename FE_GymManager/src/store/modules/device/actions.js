import Device from "../../../api/device"
export const getSupplier = ({ commit }) => {
    Device.get().then((response) => {
        commit('SET_DATA_SUPPLIER', response.data)

    })
}
export const updateDevice = ({ commit }, { id, data }) => {
    Device.update(id, data).then(() => {
        commit('UPDATE_SUPPLIER', data);
        alert('update success')
    }).catch((error) => {
        console.log(error)
    })

}
export const addDevice = ({ commit }, data) => {
    Device.store(data).then(() => {
            commit('ADD_TO_LIST', data);
            alert("Add successful")
        })
        .catch(() => {
            alert("Add failure")
        })
}
export const deleteSupplier = (({ commit }, id) => {
    Device.destroy(id).then(() => {
        commit('DELETE_ITEM', id);
    })
})
export const getByPage = (({ commit }, id) => {
    Device.getPage(id).then((response) => {
        commit('GET_PAGE', response.data);
    })
})
export const fillterByStatus = ({ commit }, id) => {
    Device.get().then((response) => {
        let data = response.data;
        commit('FILLTER', { data, id })

    })
}