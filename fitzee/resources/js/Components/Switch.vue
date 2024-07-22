<template>
  <label class="switch">
      <input type="checkbox" v-model="checked" @click="toggleSwitch" />
      <span :class="{ 'slider': true, 'checked': checked }"></span>
  </label>
</template>

<script setup>
import { ref, defineProps, defineEmits } from "vue";

const { modelValue } = defineProps(["modelValue"]);
const checked = ref(modelValue);

const emit = defineEmits();

const toggleSwitch = () => {
  checked.value = !checked.value;
  setTimeout(() => {
    emit("update:modelValue", checked.value);
  }, 0);
};
</script>

<style scoped lang="scss">
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  display: none;
}

.slider {
  position: absolute;
  cursor: pointer;
  height: 22px;
  width: 45px;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #D9D9D9;
  transition: 0.4s;
  border-radius: 34px;
}

.slider.checked {
  background-color: #7FDF5C;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 3px;
  bottom: 3px;
  background-color: #A0A0A0;
  transition: 0.4s;
  border-radius: 50%;
}

.slider.checked:before {
  background-color: $color-white;
  transform: translateX(22px);
}
</style>
