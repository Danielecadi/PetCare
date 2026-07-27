import { ref, watch } from 'vue'

export const errors = ref({});

export const validateForm = (vaccinations) => {
	errors.value = {};

	// Loop through each vaccination in the form
	for (let i = 0; i < vaccinations.length; i++) {
		const vaccination = vaccinations[i];

		// Validate vaccine_name
		if (!vaccination.vaccine_name || !vaccination.vaccine_name.trim()) {
			errors.value[`vaccinations[${i}].vaccine_name`] = 'Questo campo è obbligatorio.';
		} else if (vaccination.vaccine_name.length > 255) {
			errors.value[`vaccinations[${i}].vaccine_name`] = 'Questo campo non può superare i 255 caratteri.';
		}

		// Validate administered_at
		if (!vaccination.administered_at) {
			errors.value[`vaccinations[${i}].administered_at`] = 'Questo campo è obbligatorio.';
		  } else if (!isValidDateFormat(vaccination.administered_at)) {
			errors.value[`vaccinations[${i}].administered_at`] = 'Inserisci una data valida.';
		  }

		// Validate batch_number (optional)
		if (vaccination.batch_number && vaccination.batch_number.length > 255) {
			errors.value[`vaccinations[${i}].batch_number`] = 'Questo campo non può superare i 255 caratteri.';
		}

		// Validate administering_veterinarian (optional)
		if (vaccination.administering_veterinarian && vaccination.administering_veterinarian.length > 255) {
			errors.value[`vaccinations[${i}].administering_veterinarian`] = 'Questo campo non può superare i 255 caratteri.';
		}

		// Validate notes (optional)
		if (vaccination.notes && typeof vaccination.notes !== 'string') {
			errors.value[`vaccinations[${i}].notes`] = 'Questo campo deve contenere del testo.';
		}
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

function isValidDateFormat(dateString) {
  const regex = /^\d{4}-\d{2}-\d{2}$/;
  return regex.test(dateString);
}
