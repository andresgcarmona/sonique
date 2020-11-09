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
      <h1 :class="{ 'text-8xl': track.name.length < nameLength, 'text-5xl': track.name.length >= nameLength }"
          class="font-semibold text-6xl m-0 leading-tight">{{ track.name }}</h1>
      <p class="font-medium text-base">
        <a :href="artist.href"
           :key="artist.id"
           @click.prevent.capture="showArtist"
           class="media-artist text-sm"
           v-for="(artist, index) in track.artists.items">
          {{ artist.name }}{{ index < track.artists.items.length ? ', ' : '' }}
        </a>
        |
        <a class="text-sm" href="#">{{ duration }}</a>
        |
        <span class="text-gray-400">{{ track.album.release_date  }}</span>
      </p>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'TrackItem',
    props: {
      track: Object,
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
        if(this.track.album.images) {
          return this.track.album.images[0]
        }
      },
      duration() {
        if(this.track.duration_ms) {
          let duration = (this.track.duration_ms / 1000 / 60)
          return ('0' + parseInt(duration)).substring(-2) + ':' + ('0' + (this.track.duration_ms % 60)).substring(-2)
        }

        return ''
      },
    },
    mounted() {
      console.log(this.track)
    },
  }
</script>

<style lang="scss" scoped>
  .media-object {
    @apply w-56;
  }
</style>
