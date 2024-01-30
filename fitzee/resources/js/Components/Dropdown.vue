
<script>
import { ref, watch, defineProps, defineEmits } from 'vue';

export default {
  props: {
    label: String,
    name: String,
    value: String,
    options: Array,
    errors: Object,
  },
  setup(props, { emit }) {
    const inputValue = ref(props.value || '');
    const inputId = props.name;
    const hasError = ref(false);
    const errorMessage = ref('');

    const onInput = () => {
      emit('updateEvent', inputValue.value);
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
<template>
  <div class="input__group">
    <label class="input__label" :for="inputId" v-if="label">{{ label }}</label>
    <div class="input__container">
      <select
        class="input__input"
        :class="{ error: hasError }"
        :id="inputId"
        :name="name"
        v-model="inputValue"
        @change="onInput"
      >
        <option
          v-for="(option, index) in options"
          :key="index"
          :value="option.value"
        >{{ option.text }}</option>
      </select>
      <svg class="input__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="#000000"><path d="M24 24H0V0h24v24z" fill="none"/><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6-1.41-1.41z"/></svg>
    </div>
    <span class="error__label" v-if="hasError">{{ errorMessage }}</span>
  </div>
</template>

<style scoped lang="scss">
@import '../../scss/colors.scss';
@import '../../scss/error.scss';

.input__group {
  position: relative;
  margin-bottom: 20px;
}

.input__label {
  position: absolute;
  top: 0;
  font-size: 1rem;
  color: $color-white;
  font-weight: bold;
}

.input__container {
    margin-top: 30px;
  position: relative;
}


.input__input {
  border-radius: 15px;
  box-sizing: border-box;
  background: linear-gradient(
    180deg,
    rgba(255, 255, 255, 0.00) 0%,
    rgba(255, 255, 255, 0.10) 100%
  ),
  rgba(39, 41, 48, 0.40);
  border: none;
  padding: 12px 12px;
  color: $color-grey;
  cursor: pointer;
  width: 100%;
}

.input__icon {
    position: absolute;
    right: 10px;
    top: 25%;
    width: 24px;
    height: 24px;
    fill: $color-grey;
}

.input__input:hover,
.input__input:active,
.input__input:focus {
  box-shadow: none;
}
</style>
