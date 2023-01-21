import './bootstrap';
import '../css/app.css';
import  Alpine  from 'alpinejs';
window.Alpine = Alpine;

window.addEventListener('load', function() {
    Alpine.start();
})