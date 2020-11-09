<template>
  <div class="relative">
    <div :class="type"
         @click.prevent.capture="mediaObjectSelected"
         class="media-object text-center mb-4">
      <a class="cover-wrapper mb-2" href="#">
        <div :style="{ 'background-image': `url(${cover.url})` }" class="cover">
          <div class="overlay">
            <div class="media-controls">
              <div class="media-play-button">
                <button class="btn">
                  <i class="fas fa-play fa-lg"/>
                </button>
              </div>
            </div>
          </div>
        </div>
      </a>

      <div class="media-name">
        {{ item.name }}
      </div>
      <div class="media-artist-container" v-if="item.artists && item.artists.items && item.artists.items['0']">
        <a :href="artist.href"
           :key="artist.id"
           :data-id="artist.id"
           @click.prevent.capture="showArtist"
           class="media-artist text-sm"
           v-for="(artist, index) in item.artists.items['0']">
          {{ artist.name }}{{ index < item.artists.items['0'].length - 1 ? ', ' : '' }}
        </a>
      </div>
    </div>
  </div>
</template>

<script>
  import { map } from 'lodash'

  export default {
    name: 'MediaObject',
    props: {
      item: Object,
    },
    data() {
      return {}
    },
    methods: {
      mediaObjectSelected() {
        switch(this.type) {
          case 'album':
            this.$router.push({
              name: 'album.show',
              params: { id: this.item.id },
            })
            break
          case 'track':
            this.$router.push({
              name: 'track.show',
              params: { id: this.item.id },
            })
        }
      },

      showArtist(e) {
        const id = $(e.target).data('id')

        return this.$router.push({
          name: 'artist.show',
          params: { id },
        })
      },
    },
    computed: {

      /**
       * Returns the image of the album.
       *
       * @returns {*|string|HTMLImageElement}
       */
      cover() {
        if(this.item.images) {
          return this.item.images[0]
        }

        if(this.item.album && this.item.album.images) {
          return this.item.album.images[0]
        }
      },

      artistsNames() {
        const artists = map(this.item.artists.items, 'name')

        if(artists.length > 1) {
          return artists.join(', ')
        }

        return artists.join('')
      },

      /**
       * Returns the type of the media object.
       *
       * @returns {*}
       */
      type() {
        if(this.item.context) {
          return this.item.context.type
        }

        if(this.item.type) {
          return this.item.type
        }

        return 'album'
      },

      /**
       * Returns true if the media object is an artist.
       *
       * @returns {boolean}
       */
      isArtist() {
        return this.type() === 'artist'
      },

      /**
       * Returns true if the media object is an album.
       *
       * @returns {boolean}
       */
      isAlbum() {
        return this.type() === 'album'
      },

      /**
       * Returns true if the media object is a playlist.
       *
       * @returns {boolean}
       */
      isPlaylist() {
        return this.type() === 'playlist'
      },
    },
  }
</script>
