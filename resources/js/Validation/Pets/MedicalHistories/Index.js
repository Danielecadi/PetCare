import { ref, watch } from 'vue'

export const errors = ref({});

export const validateForm = (histories) => {
	errors.value = {};

	// Loop through each history in the form
	for (let i = 0; i < histories.length; i++) {
		const history = histories[i];

		// Validate condition
		if (!history.condition || !history.condition.trim()) {
			errors.value[`histories[${i}].condition`] = 'Questo campo è obbligatorio.';
		} else if (history.condition.length > 255) {
			errors.value[`histories[${i}].condition`] = 'Questo campo non può superare i 255 caratteri.';
		}

		// Validate diagnosis_date
		if (!history.diagnosis_date) {
			errors.value[`histories[${i}].diagnosis_date`] = 'Questo campo è obbligatorio.';
		} else if (!isValidDateFormat(history.diagnosis_date)) {
			errors.value[`histories[${i}].diagnosis_date`] = 'Inserisci una data valida.';
		}

		// Validate treatment (optional)
		if (history.treatment && history.treatment.length > 255) {
			errors.value[`histories[${i}].treatment`] = 'Questo campo non può superare i 255 caratteri.';
		}

		// Validate notes (optional)
		if (history.notes && typeof history.notes !== 'string') {
			errors.value[`histories[${i}].notes`] = 'Questo campo deve contenere del testo.';
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
