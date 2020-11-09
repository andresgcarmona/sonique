<template>
    <div class="playlists row">
        <div class="col-12">
            <playlists-list :playlists="filteredPlayLists"
                            title="Playlists"/>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters, mapMutations } from 'vuex'
    import { uniq } from 'lodash'
    import PlaylistsList from '../components/PlaylistsList'

    export default {
        name: 'Playlists',
        components: { PlaylistsList },
        beforeRouteEnter(to, from, next) {
            next(vm => {
                vm['SET_ACTIVE_SECTION']({ section: to.name })
                vm.getPlaylists()
            })
        },
        data() {
            return {
                title: 'Playlists',
                filteredPlayLists: [],
            }
        },
        methods: {
            ...mapMutations(['SET_ACTIVE_SECTION']),

            ...mapActions(['getPlaylists']),
        },
        computed: {
            ...mapGetters(['playlists']),
        },
        watch: {
            playlists() {
                this.filteredPlayLists = uniq(this.playlists, 'id')
            },
        },
    }
</script>
