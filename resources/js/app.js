import './bootstrap';
import 'bootstrap-multiselect/dist/js/bootstrap-multiselect.min.js';
import $ from 'jquery';

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  $(document).ready(function() {
    $('#country_id').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        buttonWidth: '100%'
    });
});

  // Import components...
import Multiselect from '@suadelabs/vue3-multiselect'

component('multiselect', Multiselect)
