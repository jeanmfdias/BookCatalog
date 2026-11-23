import { Controller } from '@hotwired/stimulus';
import Swal from 'sweetalert2';

export default class extends Controller {
    confirm(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Tem certeza?',
            text: 'Deseja mesmo excluir o registro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                this.element.submit();
                return;
            }
        });
    }
}
