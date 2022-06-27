import AppForm from '../app-components/Form/AppForm';

Vue.component('me-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                descripcion:  '' ,
                
            }
        }
    }

});