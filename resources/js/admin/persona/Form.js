import AppForm from '../app-components/Form/AppForm';

Vue.component('persona-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                apellidos:  '' ,
                direccion:  '' ,
                email:  '' ,
                identificacion:  '' ,
                nombres:  '' ,
                representante_persona_id:  '' ,
                status:  false ,
                telefono:  '' ,
                tipo_documento_id:  '' ,
                
            }
        }
    }

});