import auth from './auth'
import loading from './loading'
import customer from './customer'
import notification from './notification'
import common from './common'
import { createStore } from 'vuex'

export default createStore({
    modules: {
        auth,
        customer,
        loading,
        notification,
        common
    }
})