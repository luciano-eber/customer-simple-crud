<script setup>

const props = defineProps({
    label: String,
    placeholder: String,
    modelValue: String,
    invalidFeedback: String,
    type: {
        type: String,
        default: 'text'
    },
    disabled: {
        type: Boolean,
        default: false
    }
})

defineEmits([
    'update:modelValue'
])

</script>

<template>
    <div>
        <label v-show="label" class="form-label">{{ label }}</label>
        <input 
            :type="type" 
            class="form-control" 
            :class="{ 'is-invalid': invalidFeedback }"
            :placeholder="placeholder"
            :value="modelValue" 
            @input="$emit('update:modelValue', $event.target.value)"
            :disabled="disabled"
        />

        <div v-show="invalidFeedback" class="invalid-feedback">
            {{ invalidFeedback }}
        </div>                    
    </div>
</template>

<style lang="scss">
@import "bootstrap/scss/forms";
</style>