<template>
  <footer class="footer">
    <ul class="footer__menu">
        <NavLink :href="route('terms')">
            Terms & conditions
        </NavLink>
        <NavLink :href="route('cookies')">
            Cookies & usage
        </NavLink>
        <NavLink :href="route('notice')">
            Legal notice
        </NavLink>
    </ul>
  </footer>
</template>

<script setup>
import NavLink from '@/Components/NavLink.vue';

</script>

<style scoped lang="scss">
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';

.footer {
    @include space('top', 2rem);
    @include space('bottom', 2rem)
}

.footer__menu {
    display: flex;
    flex-direction: row;
    justify-content: start;
    margin: 0;
    padding: 1rem 0;
    overflow-x: auto;
}
</style>
