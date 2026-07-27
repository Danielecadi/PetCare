import { ref, watch } from 'vue'

export const errors = ref({});

export const validateForm = (surgeries) => {
	errors.value = {};

	// Loop through each surgery in the form
	for (let i = 0; i < surgeries.length; i++) {
		const surgery = surgeries[i];

		// Validate procedure_name
		if (!surgery.procedure_name || !surgery.procedure_name.trim()) {
			errors.value[`surgeries[${i}].procedure_name`] = 'Questo campo è obbligatorio.';
		} else if (surgery.procedure_name.length > 255) {
			errors.value[`surgeries[${i}].procedure_name`] = 'Questo campo non può superare i 255 caratteri.';
		}

		// Validate date
		if (!surgery.date) {
			errors.value[`surgeries[${i}].date`] = 'Questo campo è obbligatorio.';
		} else if (!isValidDateFormat(surgery.date)) {
			errors.value[`surgeries[${i}].date`] = 'Inserisci una data valida.';
		}

		// Validate surgeon (optional)
		if (surgery.surgeon && surgery.surgeon.length > 255) {
			errors.value[`surgeries[${i}].surgeon`] = 'Questo campo non può superare i 255 caratteri.';
		}

		// Validate notes (optional)
		if (surgery.notes && typeof surgery.notes !== 'string') {
			errors.value[`surgeries[${i}].notes`] = 'Questo campo deve contenere del testo.';
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
