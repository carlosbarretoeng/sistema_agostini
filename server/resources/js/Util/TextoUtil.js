export default class TextoUtil {
    static formatarParaTelefone(value){
        return value.replace(/^(\+\d{2})(\d{2})(\d{4,5})(\d{4})/, "$1 $2 $3-$4");
    }
    static formatarParaCEP(value){
        return value.replace(/^(\d{2})(\d{3})(\d{3})/, "$1.$2-$3");
    }
    static formatarParaCPF(value){
        return value.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$5");
    }
    static formatarParaCNPJ(value){
        return value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
    }
}
