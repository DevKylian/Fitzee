<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Navigation from '@/Components/Navigation.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import UserDropdown from '../Components/UserDropdown.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="container">
        <nav class="navbar">
            <div class="navbar__main">
                <Link :href="route('dashboard')" method="get" as="a">
                    <ApplicationLogo />
                </Link>

            </div>
            <div class="navbar__perso">
                <UserDropdown>
                    <ul class="user-dropdown__list">
                        <li><Link :href="route('settings.details')" method="get" as="button" type="button">Settings</Link></li>
                        <li><Link :href="route('logout')" method="post" as="button" type="button">Logout</Link></li>
                    </ul>
                </UserDropdown>
            </div>
        </nav>
        <div class="dashboard">
            <div class="dashboard__top">
                <h1 class="dashboard__title">Hey, {{ $page.props.auth.user.username }}</h1>
            </div>
            <Navigation></Navigation>
            <slot></slot>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';
@import '../../scss/dropdown.scss';

.container {
    margin-left: auto;
    margin-right: auto;
    max-width: 1280px;
    padding-left: 1rem;
    padding-right: 1rem;
}

.dashboard__top {
    width: 100%;
    text-align: start;
    margin-top: 2rem;
}

.dashboard__title {
    font-size: 2rem;
    color: white;
}

.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 85px;
    border-bottom: 0.5px solid #555555;
}

.navbar__perso {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    gap: 3rem;
}
</style>

