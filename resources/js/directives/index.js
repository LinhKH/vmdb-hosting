import numberonly from './numberonly'

export default {
  install (Vue) {
    Vue.directive('numberonly', numberonly)
    
  }
}