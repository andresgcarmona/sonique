<template>
    <li :class="{ 'has-active': activeSection === routeName }" :data-route="routeName" @click="activate"
        class="menu-item">
        <router-link :to="{ name: routeName }" class="menu-link px-2 py-1">
            <span class="menu-icon" v-if="icon">
                <i :class="icon" class="fa fa-fw"></i>
            </span>
            <span class="menu-text">{{ label }}</span>
            <span class="badge badge-subtle badge-success" v-if="badge">+13</span>
        </router-link>
    </li>
</template>

<script>
    import { mapState } from 'vuex'

    export default {
        name: 'SidebarItem',
        props: ['label', 'routeName', 'activateRoutes', 'icon', 'badge'],
        data() {
            return {
                active: false,
            }
        },
        methods: {
            activate() {
                this.$emit('item-selected', this.$router.history.current.name)
            },
        },
        computed: {
            ...mapState(['activeSection']),
        },
    }
</script>
