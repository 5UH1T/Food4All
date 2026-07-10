import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.min.css'
import 'bootstrap/dist/css/bootstrap.min.css';
import { editCategoryValidation, createCategoryValidation, createSubCategoryValidation, editSubCategoryValidation, loginValidation, userRegisterValidation, storeRegisterValidation, createProductValidation, vendorProfileValidation, createCartValidation  } from './helpers/validate';

import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

window.notyf = new Notyf({
    duration: 3000,
    position: { x: 'right', y: 'top' }
});


// Validation
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#loginForm')) {
        loginValidation();
    }

    if (document.querySelector('#userRegisterForm')) {
        userRegisterValidation();
    }

    if (document.querySelector('#storeRegisterForm')) {
        storeRegisterValidation();
    }

    if (document.querySelector('#editAdminCategory')) {
        editCategoryValidation();
    }

    if (document.querySelector('#createAdminCategory')) {
        createCategoryValidation();
    }

    if (document.querySelector('#createVendorCategory')) {
        createSubCategoryValidation();
    }

    if (document.querySelector('#editVendorCategory')) {
        editSubCategoryValidation();
    }

    if (document.querySelector('#createProductForm')) {
        createProductValidation();
    }

    if (document.querySelector('#editVendorProfile')) {
        vendorProfileValidation();
    }

    if (document.querySelector('#cartUpdateForm')) {
        createCartValidation();
    }
});