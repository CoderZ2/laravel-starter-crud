import './bootstrap';
import '../css/app.css';
import 'flowbite';
import Swal from 'sweetalert2'
import Alpine from 'alpinejs';
window.Alpine = Alpine;
window.Swal = Swal;

window.addEventListener('load', function () {
    Alpine.start();
})