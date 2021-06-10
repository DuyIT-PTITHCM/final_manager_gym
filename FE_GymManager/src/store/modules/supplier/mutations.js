export const SET_DATA_SUPPLIER = (state, data) => {
    state.supplierList = data.data;

}
export const UPDATE_SUPPLIER = (state, data) => {
    state.supplierList.map(element => {
        if (element.id === data.Id) {
            element.id = data.id
            element.name = data.name
            element.address = data.address
            element.phone = data.phone
        }

        return element
    })

}
export const ADD_TO_LIST = (state, data) => {
    state.supplierList.push(data);
}
export const DELETE_ITEM = (state, id) => {
    state.supplierList = state.supplierList.filter(item => item.id != id)
}
export const findByName = (state, inputFind) => {
    state.supplierList = state.supplierList.filter(element => element.name.toLowerCase().indexOf(inputFind.toLowerCase()) >= 0);
}
export const GET_PAGE = (state, data) => {
    state.totalPage = data.last_page
    state.supplierList = data.data;
}

export const ADD_TO_LIST_ALL = (state, data) => {
    state.allItems.push(data);
    console.log(state.allItems)
}

export const SET_DATA_TYPEALL = (state, data) => {
    state.allItems = data;

}