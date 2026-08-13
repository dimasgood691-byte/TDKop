import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Swal from 'sweetalert2';
import Chart from 'chart.js/auto';

// Inisialisasi Animate On Scroll (AOS)
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        mirror: false
    });
});

// Window Global Helper untuk SweetAlert2 & Chart
window.Swal = Swal;
window.Chart = Chart;