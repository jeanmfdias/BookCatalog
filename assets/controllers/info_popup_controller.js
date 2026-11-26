import { Controller } from '@hotwired/stimulus';
import Swal from 'sweetalert2';

export default class extends Controller {
    static values = {
        text: String
    }

    info(event) {
        event.preventDefault();

        Swal.fire({
            text: this.textValue,
            icon: 'info',
            confirmButtonText: 'Fechar'
        });
    }
}
