export default {
    canView(user, props) {
        let hasRole = true;
        let hasPermission = true;
        if(props.role != null){
            hasRole = user.roles.map(role => role.name).includes(props.role);
        }
        if(props.permission != null){
            // hasPermission = user.roles.map(role => role.permissions.map(permission => permission.name))[0].includes(props.permission)
        }

        return hasRole && hasPermission
    }
};
