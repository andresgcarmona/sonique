<template>
  <div class="track-container" v-if="track">
    <header class="flex w-full header relative pb-8 pt-4">
      <track-item :track="track"/>
    </header>
    <track-list :tracks="tracks"
                :album="track.album"
                @play-track="playTrack"></track-list>
  </div>
</template>

<script>
  import { mapActions, mapGetters, mapMutations } from 'vuex'
  import TrackItem from '../components/TrackItem'
  import TrackList from '../components/TrackList'

  export default {
    name: 'TrackPage',
    components: {
      TrackItem,
      TrackList,
    },
    beforeRouteEnter(to, from, next) {
      next(async vm => {
        vm['SET_ACTIVE_SECTION']({ section: to.name })
        // Get track.
        await vm.getTrack(to.params.id)

        // Get album's track.
        await vm.getTracks(vm.track.album.id)
      })
    },
    beforeRouteLeave(to, from, next) {
      this['tracks/SET_TRACK']({ track: null })
      this['albums/SET_ALBUMS_TRACKS']({ tracks: null })

      next()
    },
    methods: {
      ...mapActions({
        getTrack: 'tracks/getTrack',
        getTracks: 'albums/getTracks',
      }),

      ...mapMutations(['SET_ACTIVE_SECTION']),

      ...mapMutations(['tracks/SET_TRACK', 'albums/SET_ALBUMS_TRACKS']),
      
      playTrack(track) {
        this.$emit('play-track', track)
      },
    },
    computed: {
      ...mapGetters({
        track: 'tracks/track',
        tracks: 'albums/tracks',
      }),
    },
  }
</script>
