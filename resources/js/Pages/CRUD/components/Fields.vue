<script setup>
import InputField from './InputField.vue';
import SelectField from './SelectField.vue';
import PasswordField from "./PasswordField.vue";

const props = defineProps({
    field: Object
})

</script>
<template>
    <SelectField
        v-if="field['type'] === 'select' || field['type'] === 'foreign'"
        v-bind="field"
        value=""
        @update="$emit('update', $event)"
    />
    <PasswordField
        v-else-if="field['type'] === 'password'"
        v-bind="field"
        value=""
        @update="$emit('update', $event)"
    />
    <InputField
        v-else
        v-bind="field"
        value=""
        @update="$emit('update', $event)"
    />
</template>
