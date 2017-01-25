import { default as swal } from 'sweetalert2'

export default {
    destroy(data, index, callback) {
        swal({
            title: 'Esta seguro de eliminar?',
            text: 'No sera capaz de recuperar el registro!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Si, eliminalo!',
        })
            .then(() => {
                callback(data, index);
                swal(
                    'Eliminado!',
                    'El registro ha sido eliminado.',
                    'success'
                  );
            });
    }
}