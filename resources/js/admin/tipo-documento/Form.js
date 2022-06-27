import AppForm from '../app-components/Form/AppForm';

Vue.component('tipo-documento-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                descripcion:  '' ,
                status:  false ,
                
            }
        }
    }

});