import JustValidate from 'just-validate';

// Authentication Validation
export function loginValidation() {
    const validation = new JustValidate('#loginForm', {
        errorFieldCssClass: 'is-invalid',
    });

    validation
        .addField('#email', [
            {
                rule: 'required',
                errorMessage: 'Email address is required',
            },
            {
                rule: 'email',
                errorMessage: 'Please enter a valid email address',
            },
            {
                rule: 'customRegexp',
                value: /^(?!\d+@)(?![^@]+@\d)(?![^@]+@[a-zA-Z]+\d+\.)[A-Za-z][A-Za-z0-9._%+-]*@[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9]){2,}\.[A-Za-z]{2,}$/,
                errorMessage: 'Please enter a valid email address',
            },
        ])

        .addField('#password', [
            {
                rule: 'required',
                errorMessage: 'Password is required',
            },
            {
                rule: 'minLength',
                value: 6,
                errorMessage: 'Password must be at least 6 characters',
            },
        ])

        .onSuccess((event) => {
            event.target.submit();
        });
}

// User Registration Validation
export function userRegisterValidation() {
    const validation = new JustValidate('#userRegisterForm', {
        errorFieldCssClass: 'is-invalid',
    });

    validation
        .addField('#name', [
            {
                rule: 'required',
                errorMessage: 'Full name is required',
            },
            {
                rule: 'minLength',
                value: 3,
                errorMessage: 'Name must be at least 3 characters',
            },
        ])

        .addField('#email', [
            {
                rule: 'required',
                errorMessage: 'Email address is required',
            },
            {
                rule: 'email',
                errorMessage: 'Please enter a valid email address',
            },
            {
                rule: 'customRegexp',
                value: /^(?!\d+@)(?![^@]+@\d)(?![^@]+@[a-zA-Z]+\d+\.)[A-Za-z][A-Za-z0-9._%+-]*@[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9]){2,}\.[A-Za-z]{2,}$/,
                errorMessage: 'Please enter a valid email address',
            },
        ])
        
        .addField('#password', [
            {
                rule: 'required',
                errorMessage: 'Password is required',
            },
            {
                rule: 'minLength',
                value: 6,
                errorMessage: 'Password must be at least 6 characters',
            },
        ])

        .addField('#password_confirmation', [
            {
                rule: 'required',
                errorMessage: 'Please confirm your password',
            },
            {
                validator: (value, context) => {
                    return value === document.querySelector('#password').value;
                },
                errorMessage: 'Passwords do not match',
            },
        ])
        
        .addField('#phone', [
            {
                rule: 'required',
                errorMessage: 'Phone number is required',
            },
            {
                rule: 'minLength',
                value: 10,
                errorMessage: 'Phone number must be at least 10 digits',
            },
            {
                rule: 'customRegexp',
                value: /^(98|97)\d{8}$/,
                errorMessage: 'Please enter a valid phone number',
            },
        ])
        
        .addField('#address', [
            {
                rule: 'required',
                errorMessage: 'Address is required',
            },
            {
                rule: 'minLength',
                value: 5,
                errorMessage: 'Address must be at least 5 characters',
            },
        ])

        .onSuccess((event) => {
            event.target.submit();
        });
}

// Admin Catgories
export function editCategoryValidation() {
    const validation = new JustValidate('#editAdminCategory', {
        errorFieldCssClass: 'is-invalid',
    });

    validation
        .addField('#edit_category_name', [
            { rule: 'minLength', value: 3 },
            { rule: 'required', errorMessage: 'Category Title is required' },
            {
                rule: 'customRegexp',
                value: /^[A-Za-z][A-Za-z0-9\s._&-]*$/,
                errorMessage: 'Invalid Category Title',
            },
        ])
        .addField('#edit_status', [
            { rule: 'required', errorMessage: 'Please Select a Status' },
        ])
        .onSuccess(async (event) => {
            event.target.submit();
        });
}

export function createCategoryValidation() {
    const validation = new JustValidate('#createAdminCategory', {
        errorFieldCssClass: 'is-invalid',
    });

    validation
        .addField('#create_category_name', [
            { rule: 'required', errorMessage: 'Category Title is required' },
            { rule: 'minLength', value: 3 },
            {
                rule: 'customRegexp',
                value: /^[A-Za-z][A-Za-z0-9\s._&-]*$/,
                errorMessage: 'Invalid Category Title',
            },
        ])
        .addField('#create_category_status', [
            { rule: 'required', errorMessage: 'Please Select a Status' },
        ])
        .onSuccess(async (event) => {
            event.target.submit();
        });
}

// Vendor Categories
export function createSubCategoryValidation() {
    const validation = new JustValidate('#createVendorCategory', {
        errorFieldCssClass: 'is-invalid',
    });

    validation
        .addField('#create_sub_category_name', [
            { rule: 'required', errorMessage: 'Sub Category Title is required' },
            { rule: 'minLength', value: 3 },
            {
                rule: 'customRegexp',
                value: /^[A-Za-z][A-Za-z0-9\s._&-]*$/,
                errorMessage: 'Invalid Sub Category Title',
            },
        ])
        .addField('#create_sub_category_parent', [
            { rule: 'required', errorMessage: 'Please select a Main Category' },
        ])
        .addField('#create_sub_category_status', [
            { rule: 'required', errorMessage: 'Please select a Status' },
        ])
        .onSuccess(async (event) => {
            event.target.submit();
        });
}

export function editSubCategoryValidation() {
    const validation = new JustValidate('#editVendorCategory', {
        errorFieldCssClass: 'is-invalid',
    });

    validation
        .addField('#edit_sub_category_name', [
            { rule: 'required', errorMessage: 'Sub Category Title is required' },
            { rule: 'minLength', value: 3 },
            {
                rule: 'customRegexp',
                value: /^[A-Za-z][A-Za-z0-9\s._&-]*$/,
                errorMessage: 'Invalid Sub Category Title',
            },
        ])
        .addField('#edit_sub_category_parent', [
            { rule: 'required', errorMessage: 'Please select a Main Category' },
        ])
        .addField('#edit_sub_category_status', [
            { rule: 'required', errorMessage: 'Please select a Status' },
        ])
        .onSuccess(async (event) => {
            event.target.submit();
        });
}