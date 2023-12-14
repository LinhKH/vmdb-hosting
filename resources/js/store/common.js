import ServiceAPI from '../service/api'

export default {
    namespaced: true,
    state:{
    },
    mutations:{
        GET_COMMON_MST (state, mst_ids) {
            let common_mst_id = [];
            mst_ids.forEach((mst_id) => {
                if(typeof(state[mst_id]) == 'undefined'){
                    common_mst_id.push(mst_id);
                }
            });
            if(common_mst_id.length){
                ServiceAPI.axiosCall('common_master',{mst_id: common_mst_id}).then(({response})=>{
                    if(response){
                        Object.keys(response).forEach(function (key) {
                            state[key] = response[key].reduce((obj, item) => Object.assign(obj, { [item.code_value]: item }), {});
                        });
                    }   
                }).catch(()=>{
                    
                });
            }
        }
    },
    actions:{
        getCommonMst({ commit }, mst_ids){
            commit('GET_COMMON_MST', mst_ids);
        },
    }
}