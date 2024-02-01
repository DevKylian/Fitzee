<template>
  <div class="form__group">
    <label class="form__label" :for="inputId" v-if="label">
      {{ label }}
    </label>
    <input
      class="form__input"
      :type="type"
      :id="inputId"
      :name="name"
      :placeholder="placeholder"
      v-model="inputValue"
      @input="onInput"
      :required="required"
    />
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  props: {
    label: String,
    name: String,
    type: String,
    placeholder: String,
    value: String,
    required: Boolean,
  },
  setup(props) {
    const inputValue = ref(props.value || '');
    const inputId = props.name;

    const onInput = (event) => {
      inputValue.value = event.target.value;
    };

    return {
      inputValue,
      inputId,
      onInput,
    };
  },
};
</script>

<style scoped lang="scss">
@import '../../scss/colors.scss';

.form__group {
  position: relative;
  margin-bottom: 20px;
}

.form__label {
  position: absolute;
  top: 0;
  font-size: 16px;
  color: $color-white;
  font-weight: bold;
}

.form__input {
  max-width: 100%;
  border-radius: 15px;
  box-sizing: border-box;
  background: linear-gradient(180deg, rgba(255, 255, 255, 0.00) 0%, rgba(255, 255, 255, 0.10) 100%), rgba(39, 41, 48, 0.40);
  border: none;
  padding: 12px 12px;
  color: $color-grey;
  cursor: pointer;
  width: 100%;
}

.form__label + .form__input {
  margin-top: 30px;
}

.form__input:hover,
.form__input:active,
.form__input:focus {
  box-shadow: none;
}
</style>
