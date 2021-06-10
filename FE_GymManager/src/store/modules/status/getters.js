export const getDataCharts = (state)=>{
    let xxx =[];
    xxx[0] =new Array('Task','Hours per Day');
    let cc = state.statusList;
    cc.forEach(element => {
        xxx[element.id]= new Array(element.name,element.devices.length);
    });
    return xxx;
}


