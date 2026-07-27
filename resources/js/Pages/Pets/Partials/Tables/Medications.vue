<script setup>
import { defineProps } from 'vue';

// Define the props
const props = defineProps({
    pet: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div class="px-4 py-5 sm:p-6">
        <template v-if="pet.medications.length === 0">
            <p class="text-center text-gray-500 py-4">Nessun farmaco trovato.</p>
        </template>
        <template v-else>
            <table class="min-w-full divide-y divide-gray-300">
                <thead>
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Nome farmaco</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Data di somministrazione</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Dosaggio</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Frequenza</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Veterinario somministratore</th>
                        <th scope="col" class="py-3.5 text-right text-sm font-semibold text-gray-900">Note</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr v-for="medication in pet.medications" :key="medication.id">
                        <td class="whitespace-normal py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{
                            medication.medication_name }}</td>
                        <td class="whitespace-normal px-3 py-4 text-sm text-gray-500">{{ medication.administered_at }}</td>
                        <td class="whitespace-normal px-3 py-4 text-sm text-gray-500">{{ medication.dosage }}</td>
                        <td class="whitespace-normal px-3 py-4 text-sm text-gray-500">{{ medication.frequency }}</td>
                        <td class="whitespace-normal px-3 py-4 text-sm text-gray-500">{{ medication.administering_veterinarian }}
                        </td>
                        <td class="relative whitespace-normal py-4 pl-3 pr-4 text-right text-sm sm:pr-0 text-gray-500">{{
                            medication.notes }}</td>
                    </tr>
                </tbody>
            </table>
        </template>
</div></template>
