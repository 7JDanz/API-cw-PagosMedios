import AppForm from '../app-components/Form/AppForm';

Vue.component('descuento-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                descripcion:  '' ,
                grado_id:  '' ,
                max:  '' ,
                min:  '' ,
                status:  false ,
                valor:  '' ,
                
            }
        }
    }

});