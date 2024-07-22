<template>
  <div class="navigation">
    <ul class="navigation__menu">
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Overview
        </NavLink>
        <NavLink :href="route('program')" :active="route().current('program') || route().current('session')">
            Program
        </NavLink>
        <NavLink :href="route('exercises')" :active="route().current('exercises') || route().current('exercise')">
            Exercises
        </NavLink>
        <NavLink :href="route('my-profile')" :active="route().current('my-profile')">
            Profile
        </NavLink>
    </ul>
  </div>
</template>

<script setup>
import NavLink from '@/Components/NavLink.vue';
</script>

<style scoped lang="scss">
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';

.navigation {
    @include space('top', 2rem)
}

.navigation__menu {
    display: flex;
    flex-direction: row;
    justify-content: start;
    margin: 0;
    padding: 1rem 0;
    overflow-x: auto;
}

.navigation__item {
    position: relative;
    list-style: none;
    margin-right: 2rem;
}

.navigation__link {
    color: white;
    font-size: 1.125rem;
    white-space: nowrap;
}

.navigation__link:hover:before,
.navigation__link--active:before {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    bottom: -8px;
    background-color: $color-red;
}

</style>
