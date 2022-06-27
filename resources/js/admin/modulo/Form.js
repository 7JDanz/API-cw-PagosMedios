import AppForm from '../app-components/Form/AppForm';

Vue.component('modulo-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                descripcion:  '' ,
                
            }
        }
    }

});