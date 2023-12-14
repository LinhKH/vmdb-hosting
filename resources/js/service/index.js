import ServiceAPI from './api'

export default {
  install (Vue) {
    Vue.config.globalProperties.$serviceapi = ServiceAPI
    
  }
}