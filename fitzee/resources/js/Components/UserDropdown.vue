<template>
  <div class="user-dropdown" @click="toggleDropdown">
    <span class="user-dropdown__name">{{ $page.props.auth.user.username }}</span>
    <img class="user-dropdown__image" src="/img/user.png" alt="User Logo">
    <div v-if="isDropdownOpen" class="user-dropdown__menu" @click.stop :style="dropdownStyle">
      <slot></slot>
    </div>
  </div>
</template>

<script>
import { ref, onBeforeUnmount, watch } from 'vue';

export default {
  name: 'UserDropdown',
  setup() {
    const isDropdownOpen = ref(false);
    const screenWidth = window.innerWidth;

    const toggleDropdown = () => {
      isDropdownOpen.value = !isDropdownOpen.value;
    };

    const closeDropdownOnClickOutside = (event) => {
      if (!isDropdownOpen.value) return;

      const dropdown = document.querySelector('.user-dropdown');
      if (dropdown && !dropdown.contains(event.target)) {
        isDropdownOpen.value = false;
      }
    };

    watch(isDropdownOpen, (newValue) => {
      if (newValue) {
        document.addEventListener('click', closeDropdownOnClickOutside);
      } else {
        document.removeEventListener('click', closeDropdownOnClickOutside);
      }
    });

    onBeforeUnmount(() => {
      document.removeEventListener('click', closeDropdownOnClickOutside);
    });

    const dropdownStyle = ref({
      position: 'absolute',
      top: '100%',
      width: '160px',
      borderRadius: '12px',
      backgroundColor: '$color-bg-grey',
      padding: '5px',
    });

    // Ajustez la position du dropdown en fonction de la largeur de l'écran
    if (screenWidth <= 768) {
      dropdownStyle.value.right = '0';
      dropdownStyle.value.transform = 'translateX(0)';
    } else {
      dropdownStyle.value.left = '25%';
      dropdownStyle.value.transform = 'translateX(-50%)';
    }

    return {
      isDropdownOpen,
      toggleDropdown,
      dropdownStyle,
    };
  },
};
</script>

<style scoped lang="scss">
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';
@import '../../scss/dropdown.scss';

</style>
