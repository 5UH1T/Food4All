import JustValidate from 'just-validate';

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
                value: /^[A-Za-z][A-Za-z0-9\s]*$/,
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
                value: /^[A-Za-z][A-Za-z0-9\s]*$/,
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
                value: /^[A-Za-z][A-Za-z0-9\s]*$/,
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