<template>
  <div class="albums row">
    <div class="col-12">
      <albums-list :albums="filteredAlbums"
                   title="Albums"/>
    </div>
  </div>
</template>

<script>
  import { mapActions, mapGetters, mapMutations } from 'vuex'
  import AlbumsList from '../components/AlbumsList'

  export default {
    name: 'Albums',
    components: {
      AlbumsList,
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm['SET_ACTIVE_SECTION']({ section: to.name })
        vm.getAlbums()
      })
    },
    beforeRouteLeave(to, from, next) {
      $(window).off('scroll')

      next()
    },
    data() {
      return {
        title: 'Albums',
        filteredAlbums: [],
      }
    },
    methods: {
      ...mapActions({
        getAlbums: 'albums/getAlbums',
      }),

      ...mapMutations(['SET_ACTIVE_SECTION']),

      async checkScroll(e) {
        if($(document).height() - $(window).height() === $(window).scrollTop()) {
          // Set loading flag.
          this.loading = true

          // Remove event listener.
          $(window).off('scroll')

          // Fetch more albums.
          await this.getAlbums()

          if(this.request.total > this.albums.length) {
            // Add event listener again.
            $(window).on('scroll', this.checkScroll)
          }
        }
      },
    },
    computed: {
      ...mapGetters({
        albums: 'albums/albums',
        request: 'albums/request',
      }),
    },
    mounted() {
      $(window).on('scroll', this.checkScroll)
    },
    watch: {
      albums() {
        this.filteredAlbums = this.albums
      },
    },
  }
</script>
