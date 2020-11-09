<template>
  <div class="album-container relative" v-if="album">
    <header class="flex w-full header relative pb-8 pt-4" style="background: rgb(43, 34, 34)">
      <div class="album-header-overlay"></div>
      <album :album="album"/>
    </header>

    <track-list :tracks="album.tracks.items"></track-list>
  </div>
</template>

<script>
  import { mapActions, mapGetters, mapMutations } from 'vuex'
  import Album from '../components/Album'
  import TrackList from '../components/TrackList'

  export default {
    name: 'AlbumPage',
    components: {
      Album,
      TrackList,
    },
    beforeRouteEnter(to, from, next) {
      next(async vm => {
        vm['SET_ACTIVE_SECTION']({ section: to.name })

        await vm.getAlbum(to.params.id)
      })
    },
    beforeRouteLeave(to, from, next) {
      this['albums/SET_ALBUM']({ album: null })

      next()
    },
    methods: {
      ...mapActions({
        getAlbum: 'albums/getAlbum',
      }),

      ...mapMutations(['SET_ACTIVE_SECTION']),

      ...mapMutations(['albums/SET_ALBUM']),
    },
    computed: {
      ...mapGetters({
        album: 'albums/album',
      }),
    },
  }
</script>

<style lang="scss" scoped>
  .album-header-overlay {
    --glue-font-weight-normal: 400;
    --glue-font-weight-bold: 700;
    --glue-font-weight-black: 900;
    --facebook-gradient: linear-gradient(0deg, hsla(0, 0%, 100%, 0.2), hsla(0, 0%, 100%, 0.2)) #1877f2;
    font-size: 14px;
    line-height: 20px;
    letter-spacing: .015em;
    font-weight: var(--glue-font-weight-normal);
    text-transform: none;
    -webkit-font-smoothing: antialiased;
    -webkit-box-direction: normal;
    color: #fff;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    border: 0;
    vertical-align: baseline;
    display: block;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, .5));
  }
</style>
