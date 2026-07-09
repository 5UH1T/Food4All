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
                rule: 'customRegexp',
                value:  /^(?=(?:.*[A-Za-z]){2})[A-Za-z][A-Za-z\s.'-]*$/,
                errorMessage: 'Please enter a valid store name',
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

// Store Registration Validation
export function storeRegisterValidation() {
    const validation = new JustValidate('#storeRegisterForm', {
        errorFieldCssClass: 'is-invalid',
    });

    validation
        .addField('#name', [
            {
                rule: 'required',
                errorMessage: 'Store name is required',
            },
            {
                rule: 'customRegexp',
                value:  /^(?=(?:.*[A-Za-z]){2})[A-Za-z][A-Za-z\s.'-]*$/,
                errorMessage: 'Please enter a valid store name',
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

        .addField('#pan', [
            {
                rule: 'required',
                errorMessage: 'PAN number is required',
            },
            {
                rule: 'customRegexp',
                value: /^\d{9}$/,
                errorMessage: 'Please enter a valid PAN number',
            },
        ])

        .onSuccess((event) => {
            event.target.submit();
        });
}

//Update Vendor Profile Validation
export function vendorProfileValidation() {
    const validation = new JustValidate('#editVendorProfile', {
        errorFieldCssClass: 'is-invalid',
    });

    validation

        .addField('#name', [
            {
                rule: 'required',
                errorMessage: 'Store name is required',
            },
            {
                rule: 'customRegexp',
                value: /^(?=(?:.*[A-Za-z]){2})[A-Za-z][A-Za-z\s.'-]*$/,
                errorMessage: 'Please enter a valid store name',
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
                value: 3,
                errorMessage: 'Address must be at least 3 characters',
            },
        ])

        .addField('#pan', [
            {
                rule: 'required',
                errorMessage: 'PAN number is required',
            },
            {
                rule: 'customRegexp',
                value: /^\d{9}$/,
                errorMessage: 'Please enter a valid PAN number',
            },
        ])

        .addField('#map', [
            {
                validator: (value) => {
                    if (!value) return true;
                    return /^https:\/\//.test(value);
                },
                errorMessage: 'Map link must start with https://',
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

export function createProductValidation() {
    const validation = new JustValidate('#createProductForm', {
        errorFieldCssClass: 'is-invalid',
    });

    validation
        .addField('input[name="title"]', [
            {
                rule: 'required',
                errorMessage: 'Product title is required',
            },
            {
                rule: 'minLength',
                value: 3,
                errorMessage: 'Product title must be at least 3 characters',
            },
            {
                rule: 'customRegexp',
                value: /^[a-zA-Z].*$/,
                errorMessage: 'Product title must start with a letter and contain only valid characters',
            },
        ])

        .addField('input[name="price"]', [
            {
                rule: 'required',
                errorMessage: 'Price is required',
            },
            {
                rule: 'number',
                errorMessage: 'Price must be a valid number',
            },
            {
                rule: 'minNumber',
                value: 0,
                errorMessage: 'Price cannot be less than 0',
            },
            {
                rule: 'maxNumber',
                value: 9999,
                errorMessage: 'Price is above the allowed range',
            },
        ])

        .addField('input[name="stock"]', [
            {
                rule: 'required',
                errorMessage: 'Stock is required',
            },
            {
                rule: 'number',
                errorMessage: 'Stock must be a valid number',
            },
            {
                rule: 'minNumber',
                value: 1,
                errorMessage: 'Stock must be at least 1',
            },
            {
                rule: 'maxNumber',
                value: 999,
                errorMessage: 'Stock is above the allowed range',
            },
        ])

        .addField('input[name="initial_price"]', [
            {
                validator: (value) => {
                    if (!value) return true;

                    const price = Number(document.querySelector('input[name="price"]').value);
                    const initialPrice = Number(value);

                    return initialPrice >= price;
                },
                errorMessage: 'Initial price cannot be less than price',
            },
            {
                rule: 'maxNumber',
                value: 9999,
                errorMessage: 'Price is above the allowed range ',
            },
        ])

        .addField('#selectCategory', [
            {
                rule: 'required',
                errorMessage: 'Please select a Main Category',
            },
        ])

        .addField('#selectSubCategory', [
            {
                rule: 'required',
                errorMessage: 'Please select a Category',
            },
        ])

        .addField('select[name="status"]', [
            {
                rule: 'required',
                errorMessage: 'Please select a Status',
            },
        ])

        .onSuccess((event) => {
            event.target.submit();
        });
    }