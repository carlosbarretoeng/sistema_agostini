import moment from "moment";
import 'moment/locale/pt-br';

export default {
    secondsToTimestamp(seconds) {
        let date = new Date(null);
        date.setSeconds(seconds);
        const result = date.toISOString().substr(11, 8);
        return result
    },
    toFormatedString(date) {
        moment.locale('pt-br');
        return moment(date).format("D [de] MMM [de] YYYY", 'pt-br')
    },
    YYYYMMDDtoDDMMYYYY(str) {
        return moment(str, "YYYY-MM-DD").format("DDMMYYYY")
    }
};
