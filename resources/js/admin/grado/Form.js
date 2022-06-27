import AppForm from '../app-components/Form/AppForm';

Vue.component('grado-form', {
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