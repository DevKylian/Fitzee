<template>
  <div class="input__group">
    <label class="input__label" :for="inputId" v-if="label">{{ label }}</label>
    <input
      class="input__input"
      :class="{ error: hasError }"
      :type="type"
      :id="inputId"
      :name="name"
      :placeholder="placeholder"
      v-model="inputValue"
      @input="onInput"
    />
    <span class="error__label" v-if="hasError">{{ errorMessage }}</span>
  </div>
</template>

<script>
import { ref, watch } from 'vue';

export default {
  props: {
    label: String,
    name: String,
    type: String,
    placeholder: String,
    value: String,
    errors: Object,
  },
  setup(props, { emit }) {
    const inputValue = ref(props.value || '');
    const inputId = props.name;
    const hasError = ref(false);
    const errorMessage = ref('');

    const onInput = (event) => {
      inputValue.value = event.target.value;
      emit('update:modelValue', inputValue.value);
    };

    watch(
      () => props.errors && props.errors[inputId],
      (error) => {
        hasError.value = !!error;
        errorMessage.value = error || '';
      }
    );

    return {
      inputValue,
      inputId,
      onInput,
      hasError,
      errorMessage,
    };
  },
};
</script>

<style scoped lang="scss">
@import '../../scss/colors.scss';
@import '../../scss/input.scss';
@import '../../scss/error.scss';

</style>
