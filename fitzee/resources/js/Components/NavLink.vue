<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'navigation__link--active'
        : ''
);
</script>

<template>
    <li class="navigation__item">
        <Link :href="href" :class="classes" class="navigation__link">
            <slot />
        </Link>
    </li>
</template>

<style lang="scss" scoped>
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';

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
