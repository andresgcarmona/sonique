<template>
    <recently-played :items="filteredItems"
                     :max-items="6"
                     title="Recently played"/>
</template>

<script>
    import RecentlyPlayed from '../components/RecentlyPlayed'
    import { mapActions, mapGetters, mapMutations } from 'vuex'
    import { uniqBy } from 'lodash'

    export default {
        name: 'Dashboard',
        components: {
            RecentlyPlayed,
        },
        beforeRouteEnter(to, from, next) {
            next(vm => {
                vm['SET_ACTIVE_SECTION']({ section: to.name })
                vm.getRecentlyPlayed()
            })
        },
        data() {
            return {
                filteredItems: [],
            }
        },
        methods: {
            ...mapActions(['getRecentlyPlayed']),

            ...mapMutations(['SET_ACTIVE_SECTION']),
        },
        computed: {
            ...mapGetters(['recentlyPlayed']),
        },
        watch: {
            recentlyPlayed() {
                this.filteredItems = uniqBy(this.recentlyPlayed, 'id')
            },
        },
    }
</script>
