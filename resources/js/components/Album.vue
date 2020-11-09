<template>
  <div class="relative flex w-full items-end px-2 md:px-8">
    <div class="media-object text-center w-56 mr-4 album-art">
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
    </div>

    <div class="flex flex-col">
      <h1 :class="{ 'text-8xl': album.name.length < nameLength, 'text-5xl': album.name.length >= nameLength }"
          class="font-semibold m-0 leading-tight tracking-tighter">{{ album.name }}</h1>
      <div class="font-medium text-sm">
        <a :href="artist.href"
           :key="artist.id"
           @click.prevent.capture="showArtist"
           class="media-artist"
           v-for="(artist, index) in album.artists.items">
          {{ artist.name }}{{ index < album.artists.items.length - 1 ? ', ' : '' }}
        </a>
        <a class="media-artists-label" href="#">{{ album.label }}</a>
        <span class="media-artists-release-date text-gray-400">{{ album.release_date  }}</span>
        <span class="media-album-total-time text-gray-400">{{ totalAlbumPlayTime }}</span>
      </div>
    </div>
  </div>
</template>

<script>
  import { sumBy } from 'lodash'

  export default {
    name: 'Album',
    props: {
      album: Object,
    },
    data() {
      return {
        nameLength: 30,
      }
    },
    methods: {
      showArtist(e) {
        const href = $(e.target).attr('href')
        console.log(href)
      },
    },
    computed: {
      cover() {
        if(this.album.images) {
          return this.album.images[0]
        }

        if(this.album.album && this.album.album.images) {
          return this.album.album.images[0]
        }
      },

      totalAlbumPlayTime() {
        let durationInSeconds = sumBy(this.album.tracks.items, track => {
          return track.duration_ms / 1000
        })

        // Duration in minutes.
        let duration = durationInSeconds / 60

        if(duration > 60) {
          let hours   = Math.floor(duration / 60)
          let minutes = Math.floor(duration % 60)

          return hours + ' h ' + minutes + ' min'
        }

        let minutes = Math.floor(duration)
        let seconds = Math.floor((durationInSeconds / 1000) % 60)

        return minutes + ' min ' + seconds + ' sec'
      },
    },
  }
</script>

<style lang="scss" scoped>
  .media-object {
    @apply w-56;
  }
</style>
