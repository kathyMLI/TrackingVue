import { default as swal } from 'sweetalert2'

export default {
    destroy(data, index, callback) {
        swal({
            title: 'Está seguro de eliminar?',
            text: 'No será capaz de recuperar el registro!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Si, elimínalo!',
        })
            .then(() => {
                callback(data, index);
                setTimeout(function() {
                    swal(
                    'Eliminado!',
                    'El registro ha sido eliminado.',
                    'success'
                  );
                }, 2000);
            });
    }
}