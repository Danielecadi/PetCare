// ClientsValidation.js
import { ref, watch } from 'vue'

export const errors = ref({});

export const validateForm = (form) => {
    // Clear previous errors
    errors.value = {};

    // If form is undefined, return early
    if (!form) {
        return;
    }

    // Validate name (trimming whitespace)
    if (!form.name || !form.name.trim()) {
        errors.value.name = 'Questo campo è obbligatorio'; // 
    }

    // Validate email (trimming whitespace)
    if (!form.email || !form.email.trim()) {
        errors.value.email = 'Questo campo è obbligatorio'; 
    } else if (!/^\S+@\S+\.\S+$/.test(form.email.trim())) {
        errors.value.email = 'Per favore, inserisci un indirizzo email valido'; // Italian for "Please enter a valid email address"
    }

    // Validate phone_number (trimming whitespace)
    if (!form.phone_number || !form.phone_number.trim()) {
        errors.value.phone_number = 'Questo campo è obbligatorio'; // Italian for "This field is required"
    } // Additional validation can be added for phone_number if needed

    // Validate address (trimming whitespace if it's a string)
    if (form.address && typeof form.address === 'string' && !form.address.trim()) {
        errors.value.address = 'This field cannot be only spaces';
    } else if (form.address && typeof form.address !== 'string') {
        errors.value.address = 'This field must be a string';
    }
};

export const clearError = (field) => {
    if (errors.value[field]) {
        errors.value[field] = '';
    }
};

export const watchFields = (form) => {
    Object.keys(form).forEach(field => {
        watch(() => form[field], () => {
            clearError(field);
        });
    });
};