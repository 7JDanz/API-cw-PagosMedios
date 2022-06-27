import AppForm from '../app-components/Form/AppForm';

Vue.component('matricula-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                fecha_fin:  '' ,
                fecha_inicio:  '' ,
                grado_id:  '' ,
                persona_id:  '' ,
                status:  false ,
                
            }
        }
    }

});