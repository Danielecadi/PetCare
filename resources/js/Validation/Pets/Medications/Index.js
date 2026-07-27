import { ref, watch } from 'vue'

export const errors = ref({});

export const validateForm = (medications) => {
	errors.value = {};

	// Loop through each medication in the form
	for (let i = 0; i < medications.length; i++) {
		const medication = medications[i];

		// Validate medication_name
		if (!medication.medication_name || !medication.medication_name.trim()) {
			errors.value[`medications[${i}].medication_name`] = 'Questo campo è obbligatorio.';
		} else if (medication.medication_name.length > 255) {
			errors.value[`medications[${i}].medication_name`] = 'Questo campo non può superare i 255 caratteri.';
		}

		// Validate administered_at
		if (!medication.administered_at) {
			errors.value[`medications[${i}].administered_at`] = 'Questo campo è obbligatorio.';
		} else if (!isValidDateFormat(medication.administered_at)) {
			errors.value[`medications[${i}].administered_at`] = 'Inserisci una data valida.';
		}

		// Validate dosage (optional)
		if (medication.dosage && medication.dosage.length > 255) {
			errors.value[`medications[${i}].dosage`] = 'Questo campo non può superare i 255 caratteri.';
		}

		// Validate frequency (optional)
		if (medication.frequency && medication.frequency.length > 255) {
			errors.value[`medications[${i}].frequency`] = 'Questo campo non può superare i 255 caratteri.';
		}

		// Validate administering_veterinarian (optional)
		if (medication.administering_veterinarian && medication.administering_veterinarian.length > 255) {
			errors.value[`medications[${i}].administering_veterinarian`] = 'Questo campo non può superare i 255 caratteri.';
		}

		// Validate notes (optional)
		if (medication.notes && typeof medication.notes !== 'string') {
			errors.value[`medications[${i}].notes`] = 'Questo campo deve contenere del testo.';
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
