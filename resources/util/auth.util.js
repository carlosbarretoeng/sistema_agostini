export default {
    testaPerfil: (usuario, role) => {
        return _.union(usuario.roles.map(el => {
            return el.name;
        })).indexOf(role) > -1;
    },

    testaPermissao: (usuario, permissao) => {
        console.log(usuario.roles)
        return _.union(usuario.roles.map(el => {
            return el.permissions.map(ell => ell.name);
        }))[0].indexOf(permissao) > -1;
    }
}