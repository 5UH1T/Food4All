import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.min.css'
import 'bootstrap/dist/css/bootstrap.min.css';
import { editCategoryValidation, createCategoryValidation } from './helpers/validate';

import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

window.notyf = new Notyf({
    duration: 3000,
    position: { x: 'right', y: 'top' }
});


// Validation
document.addEventListener('DOMContentLoaded', () => {
    editCategoryValidation();
    createCategoryValidation();
});