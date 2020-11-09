<template>
    <ul class="menu">
        <sidebar-item :activate-routes="['index', 'dashboard', 'home']"
                      @item-selected="itemSelected"
                      icon="fa-home"
                      label="Home"
                      route-name="dashboard"/>

        <sidebar-item :activate-routes="['now_playing']"
                      @item-selected="itemSelected"
                      icon="fa-play"
                      label="Now Playing"
                      route-name="now_playing"/>

        <li class="menu-divider"/>

        <sidebar-item :activate-routes="['albums']"
                      @item-selected="itemSelected"
                      icon="fa-compact-disc"
                      label="Albums"
                      route-name="albums"/>

        <sidebar-item :activate-routes="['now_playing']"
                      @item-selected="itemSelected"
                      icon="fa-list"
                      label="Playlists"
                      route-name="playlists"/>
    </ul>
</template>

<script>
    import SidebarItem from './SidebarItem'

    export default {
        name: 'Sidebar',
        components: {
            SidebarItem,
        },
        methods: {
            itemSelected(routeName) {
                $(this.$el).find('.has-active').removeClass('has-active')
                $(this.$el).find('[data-route="' + routeName + '"]').addClass('has-active')

                // Looper.hideAside()
            },
        },
    }
</script>
