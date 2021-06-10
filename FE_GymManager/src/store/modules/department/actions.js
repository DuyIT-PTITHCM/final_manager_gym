import Department from "../../../api/department"
export const getSupplier = ({ commit }) => {
    Department.get().then((response) => {
        commit('SET_DATA_SUPPLIER', response.data)

    })
}
export const getDepartment = ({ commit }) => {
    Department.get().then((response) => {
        commit('SET_DATA_SUPPLIER', response.data)
    })
}
export const updateDepartment = ({ commit }, { id, data }) => {
    Department.update(id, data).then(() => {
        commit('UPDATE_SUPPLIER', data);
    }).catch((error) => {
        console.log(error)
    })

}
export const addDepartment = ({ commit }, data) => {
    Department.store(data).then(() => {
            commit('ADD_TO_LIST', data);
        })
        .catch((error) => {
            console.log(error)
            alert("Add failure")
        })
}
export const deleteSupplier = (({ commit }, id) => {
    Department.destroy(id).then(() => {
        commit('DELETE_ITEM', id);
    })
})
export const getByPage = (({ commit }, id) => {
    Department.getPage(id).then((response) => {
        commit('GET_PAGE', response.data);

    })
})
export const getDe = ({ commit }) => {
    Department.getAll().then((response) => {
        commit('SET_DATA_TYPEALL', response.data)
    })
}
export const addDeItem = ({ commit }, data) => {
    Department.store(data).then(() => {
            commit('ADD_TO_LIST_ALL', data);
            alert("Add successful")
        })
        .catch((error) => {
            console.log(error)
            alert("Add failure")
        })
}