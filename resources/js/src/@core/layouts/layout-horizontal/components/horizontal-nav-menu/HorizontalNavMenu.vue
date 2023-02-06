<template>
    <div
        class="navbar-container main-menu-content d-flex content align-items-center justify-content-between"
    >
        <b-col cols="auto" class="mr-3 mr-md-5 py-1">
            <b-link class="navbar-brand" to="/dashboard">
                <span class="brand-logo">
                    <h4 class="mb-0 font-weight-bold">
                        Utility Choice Program
                    </h4>
                </span>
            </b-link>
        </b-col>
        <div class="d-none d-lg-block">
            <horizontal-nav-menu-items :items="navMenuItems" />
        </div>
        <b-navbar-nav class="nav align-items-center ml-auto">
            <!-- <dark-Toggler class="d-none d-lg-block" /> -->
            <!-- <search-bar /> -->
            <!-- <notification-dropdown /> -->
            <b-link
                class="nav-link d-inline-block d-lg-none"
                @click="toggleVerticalMenuActive"
            >
                <feather-icon icon="MenuIcon" size="21" />
            </b-link>
            <user-dropdown />
        </b-navbar-nav>
    </div>
</template>

<script>
import { $themeConfig } from "@themeConfig";
import { BCol, BNavbarNav, BLink, BImg } from "bootstrap-vue";
import navMenuItems from "@/navigation/horizontal";
import HorizontalNavMenuItems from "./components/horizontal-nav-menu-items/HorizontalNavMenuItems.vue";
import DarkToggler from "@core/layouts/components/app-navbar/components/DarkToggler.vue";
import SearchBar from "@core/layouts/components/app-navbar/components/SearchBar.vue";
import NotificationDropdown from "@core/layouts/components/app-navbar/components/NotificationDropdown.vue";
import UserDropdown from "@core/layouts/components/app-navbar/components/UserDropdown.vue";

export default {
    components: {
        BLink,
        BImg,
        BCol,
        HorizontalNavMenuItems,
        BNavbarNav,
        DarkToggler,
        SearchBar,
        NotificationDropdown,
        UserDropdown,
    },
    props: {
        toggleVerticalMenuActive: {
            type: Function,
            default: () => {},
        },
    },
    setup() {
        const { appName, appLogoImage } = $themeConfig.app;
        return {
            navMenuItems,
            appName,
            appLogoImage,
        };
    },
};
</script>

<style lang="scss">
@import "~@core/scss/base/core/menu/menu-types/horizontal-menu.scss";
</style>
