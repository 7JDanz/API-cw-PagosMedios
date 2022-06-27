import AppForm from '../app-components/Form/AppForm';

Vue.component('concepto-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                descripcion:  '' ,
                grado_id:  '' ,
                valor:  '' ,
                
            }
        }
    }

});