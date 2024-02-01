<template>
  <button class="custom-button" :class="colorClass" @click="handleClick">
    {{ label }}
  </button>
</template>

<script>
import { ref, computed, watch } from "vue";

export default {
  props: {
    label: String,
    color: String,
  },
  setup(props) {
    const colorClass = computed(() => {
      if (props.color === "gradient") {
        return "color-gradient";
      } else if (props.color === "red") {
        return "color-red";
      } else {
        return "color-default";
      }
    });

    const handleClick = () => {
      console.log("Bouton cliqué !");
    };

    return {
      colorClass,
      handleClick,
    };
  },
};
</script>

<style scoped lang="scss">
@import '../../scss/colors.scss';

.custom-button {
  border: none;
  width: 100%;
  border-radius: 10px;
  padding: 12px 20px;
  cursor: pointer;
  font-size: 16px;
  transition-duration: .3s;
  color: $color-white;
  font-weight: bold;
}

.color-gradient {
  background: $color-gradient;
}

.color-red {
  background: $color-red;
}

.custom-button:hover {
  transition-duration: .3s;
  opacity: .9;
}
</style>
