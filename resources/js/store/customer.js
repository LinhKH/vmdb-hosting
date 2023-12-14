import ServiceAPI from '../service/api'

export default {
    namespaced: true,
    state:{
        list:[]
    },
    getters:{
        list(state){
            return state.list
        }
    },
    mutations:{
        SET_LIST (state, value) {

            state.list = value
        },
    },
    actions:{
        getList({commit}){
            return ServiceAPI.axiosCall('listCustomer',{}).then(({response})=>{
                commit('SET_LIST',response.data)
            }).catch(()=>{
                commit('SET_LIST', [])
            });
        },
    }
}