<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <input
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
    />
<<<<<<< Updated upstream
</template>
=======
    <label :for="inputId" @click.prevent="toggleCheckbox">{{ label }}</label>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  props: {
    label: String,
    name: String,
    value: Boolean,
  },

  setup(props, { emit }) {
    const checked = ref(props.value || false);
    const inputId = props.name;

    const toggleCheckbox = () => {
      checked.value = !checked.value;
      emit('update:modelValue', checked.value);
      checked.value ? emit('update:checked', true): emit('update:checked', false);
    };

    return {
      checked,
      inputId,
      toggleCheckbox,
    };
  },
};
</script>

<style lang="scss" scoped>
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';

.checkbox {
  display: flex;
  align-items: center;
}

.checkbox input[type="checkbox"] {
  background: linear-gradient(180deg, rgba(255, 255, 255, 0.00) 0%, rgba(255, 255, 255, 0.10) 100%), rgba(39, 41, 48, 0.40);
  width: 22px;
  height: 22px;
  border-radius: 5px;
  @include space('right', 12px);
  border: none;
  outline: none;
  position: relative;
  box-shadow: none;
}

.checkbox input[type="checkbox"]:hover {
    cursor: pointer;
}

.checkbox input[type="checkbox"]:checked {
  background: $color-bg-grey;
  border-radius: 5px;
}

.checkbox input[type="checkbox"]:checked::before {
  content: "";
  width: 12px;
  height: 6px;
  border-bottom: 2px solid #fff;
  border-left: 2px solid #fff;
  position: absolute;
  top: 45%;
  left: 55%;
  transform: translate(-50%, -50%) rotate(-45deg);
}

.checkbox label {
  font-size: 1rem;
  color: $color-grey;
}

.checkbox label:hover {
    cursor: pointer;
}
</style>
>>>>>>> Stashed changes
