export default {
    install(Vue) {
        Vue.config.globalProperties.$imgUrl = import.meta.env.VITE_BASE_PATH+'img/';
        Vue.config.globalProperties.$filters = {
            formatNumber(number) {
                if(!number){
                    return 0;
                }
                return Intl.NumberFormat().format(number);
            },

            str_limit(value, size) {
                if (!value) return '';
                value = value.toString();
            
                if (value.length <= size) {
                  return value;
                }
                return value.substr(0, size) + '...';
            }
        };
        Vue.config.globalProperties.$clientTimeZone = import.meta.env.VITE_CLIENT_TIME_ZONE;

    }
}