import axios from 'axios'
import ServiceAPI from "../service/api";

export default {
    namespaced: true,
    state: {
        authenticated: false,
        user: {}
    },
    getters: {
        authenticated(state) {
            return state.authenticated
        },
        user(state) {
            return state.user
        }
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value
        },
        SET_USER(state, value) {
            state.user = value
        }
    },
    actions: {
        login({ commit }) {
            return ServiceAPI.axiosCall("user_info", {})
                .then((res) => {
                    if (!res.error) {
                        commit('SET_USER', res.response)
                        commit('SET_AUTHENTICATED', true)
                    } else {
                        commit('SET_USER', {})
                        commit('SET_AUTHENTICATED', false)
                    }
                })
                .catch((err) => {
                    commit('SET_USER', {})
                    commit('SET_AUTHENTICATED', false)
                });

        },
        logout({ commit }) {
            commit('SET_USER', {})
            commit('SET_AUTHENTICATED', false)
        }
    }
}