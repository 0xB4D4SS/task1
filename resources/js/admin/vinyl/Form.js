import AppForm from '../app-components/Form/AppForm';

Vue.component('vinyl-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                author:  '' ,
                year:  '' ,
                
            }
        }
    }

});