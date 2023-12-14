import moment from "moment";
import { listItemPerPage } from '@/const';
export default {
    getColorForYN($status) {
        switch ($status) {
            case 'Y':
                return 'text-blue';
            case 'N':
                return 'text-red';
            default:
                return'';
        }
    },
    getColorSupportCountryStopYN($status) {
        switch ($status) {
            case 'N':
                return 'text-blue';
            case 'Y':
                return 'text-red';
            default:
                return'';
        }
    },

    formatDateTime($value, $format='Y/MM/DD HH:mm'){
        return moment($value).format($format);
    },

    getListItemPerPage(){
        return listItemPerPage;
    },

    getTermialName(master, key = 'terminal') {
        if (master) {
            var arrVal = [];
            master.forEach(function (v) {
                if (v[key]) {
                    arrVal.push(v[key]['name']);
                }
            });
            return arrVal.join(', ');
        }
    },

}