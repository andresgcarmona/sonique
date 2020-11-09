<template>
  <div class="artist-container" v-if="artist">
    <header class="flex w-full header cover relative pb-8 pt-4" style="background-color: rgb(43, 34, 34)" v-if="artist">
      <div class="artist-header-overlay"></div>
      <artist :artist="artist" :show-cover="true"/>
    </header>

    <albums-list :albums="albums"></albums-list>
  </div>
</template>

<script>
  import { mapActions, mapGetters, mapMutations } from 'vuex'
  import Artist from '../components/Artist'
  import AlbumsList from '../components/AlbumsList'

  export default {
    name: 'ArtistPage',
    components: {
      AlbumsList,
      Artist,
    },
    beforeRouteEnter(to, from, next) {
      next(async vm => {
        vm['SET_ACTIVE_SECTION']({ section: to.name })

        await vm.getArtist(to.params.id)
        await vm.getAlbums(to.params.id)
      })
    },
    beforeRouteLeave(to, from, next) {
      this['artists/SET_ARTIST']({ artist: null })
      this['artists/SET_ALBUMS']({ albums: [] })

      next()
    },
    methods: {
      ...mapActions({
        getArtist: 'artists/getArtist',
        getAlbums: 'artists/getAlbums',
      }),

      ...mapMutations(['SET_ACTIVE_SECTION']),

      ...mapMutations(['artists/SET_ARTIST', 'artists/SET_ALBUMS']),
    },
    computed: {
      ...mapGetters({
        artist: 'artists/artist',
        albums: 'artists/albums',
      }),

      cover() {
        if(this.artist.images) {
          return this.artist.images[0]
        }

        if(this.artist.artist && this.artist.artist.images) {
          return this.artist.artist.images[0]
        }
      },
    },
  }
</script>

<style lang="scss" scoped>
  .artist-header-overlay {
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
