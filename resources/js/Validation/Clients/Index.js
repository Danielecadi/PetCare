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
        errors.value.name = 'Questo campo è obbligatorio';
    }

    // Validate email (trimming whitespace)
    if (!form.email || !form.email.trim()) {
        errors.value.email = 'Questo campo è obbligatorio';
    } else if (!/^\S+@\S+\.\S+$/.test(form.email.trim())) {
        errors.value.email = 'Inserisci un indirizzo email valido';
    }

    // Validate phone_number (trimming whitespace)
    if (!form.phone_number || !form.phone_number.trim()) {
        errors.value.phone_number = 'Questo campo è obbligatorio';
    } // Additional validation can be added for phone_number if needed

    // Validate address (trimming whitespace if it's a string)
    if (form.address && typeof form.address === 'string' && !form.address.trim()) {
        errors.value.address = 'Questo campo non può contenere solo spazi';
    } else if (form.address && typeof form.address !== 'string') {
        errors.value.address = 'Questo campo deve contenere del testo';
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
