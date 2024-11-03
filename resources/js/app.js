import './bootstrap';

import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css'; // Import CSS flatpickr

document.addEventListener('DOMContentLoaded', function () {
    flatpickr('.flatpickr-time', {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
});