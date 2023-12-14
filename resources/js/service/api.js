import axios from "axios";
import listApi from "./listapi";
import router from '../router';
import store from '../store';

const axiosInstance = axios.create({});

axiosInstance.interceptors.request.use((config) => {
    store.commit("loading/setLoading", true);
    return config;
});

axiosInstance.interceptors.response.use(
    (res) => {
        store.commit("loading/setLoading", false);
        return Promise.resolve(res.data);
    },
    (err) => {
        store.commit("loading/setLoading", false);
        return Promise.reject(err);
    }
);

const ServiceAPI = {
    async axiosCall($apiName, $data, $files = [], $options = {}) {
        try {
            if ($apiName && typeof listApi[$apiName] !== 'undefined') {
                const oApi = listApi[$apiName];
                const url = import.meta.env.VITE_BASE_URL + oApi.url;
                if (oApi.method == 'UPLOAD') {
                    let params = {};
                    let listFile = [];
                    if (typeof ($files.length) != 'undefined') {
                        for (var iInput = 0; iInput < $files.length; iInput++) {
                            listFile.push($files[iInput])
                        }
                    } else {
                        listFile.push($files)
                    }
                    for (var iFile = 0; iFile < listFile.length; iFile++) {
                        var oFile = listFile[iFile];
                        let fileNm = oFile.getAttribute('name');
                        if (oFile.files.length > 1) {
                            let files = [];
                            for (var i = 0; i < oFile.files.length; i++) {
                                files.push(oFile.files[i])
                            }
                            params[fileNm + '[]'] = files;
                        } else {
                            params[fileNm] = oFile.files[0];
                        }
                    }
                    params = Object.assign(params, $data);
                    let response = await axiosInstance.postForm(url, params);
                    return { error: null, response };
                } else {
                    let config = {
                        method: oApi.method,
                        url: url
                    };
                    if (oApi.method == 'GET') {
                        config.params = $data;
                    } else {
                        config.data = $data;
                    }
                    config = Object.assign(config, $options);
                    let response = await axiosInstance.request(config);
                    return { error: null, response };
                }
            }
            console.log('api error');
        } catch (error) {
            let error_content = parseError(error);
            if (error_content.code == 419) {
                router.go('/login')
                return;
            } else {
                return { error: error_content };
            }
        }
    }
}

const parseError = (error) => {
    const res = {
        message: [],
        code: error.response ? error.response.status : null,
    }
    if (error.response.status == 401) {
        if(typeof(error.response.data.message) == "string"){
            res.message = [error.response.data.message];
        }else{
            res.message = error.response.data.message;
        }
    }
    else if (error.response.status == 422) {
        res.message = error.response.data.errors;
    }else if(error.response.status == 500){
        store.dispatch("notification/addNotification", {
            message: error.response.statusText,
            type: "danger"
        })
        res.message = [error.response.statusText];
    } else {
        res.message = [error.response.statusText];
    }
    return res;
}

export default ServiceAPI;