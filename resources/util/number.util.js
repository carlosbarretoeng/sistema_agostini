export default {
    format(num, places = 2) {
        return num.toFixed(places)
    },
    moneyFormat(valor) {
        return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valor)
    }
};
