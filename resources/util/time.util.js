import moment from "moment";
import 'moment/locale/pt-br';

export default {
    secondsToTimestamp(seconds) {
        let date = new Date(null);
        date.setSeconds(seconds);
        const result = date.toISOString().substr(11, 8);
        return result
    },

    toFormatedString(date, format = "DD/MM/YYYY HH:mm:ss") {
        moment.locale('pt-br');
        return moment(date).format(format)
    },

    YYYYMMDDtoDDMMYYYY(str) {
        return moment(str, "YYYY-MM-DD").format("DDMMYYYY")
    }
};
