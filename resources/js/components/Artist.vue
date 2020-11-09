<template>
  <div class="relative flex w-full items-end px-2 md:px-8">
    <div class="media-object text-center w-56 mr-4 artist-art" v-if="showCover">
      <a class="cover-wrapper mb-2" href="#">
        <div :style="{ 'background-image': `url(${cover.url})` }" class="cover">
          <div class="overlay">
          </div>
        </div>
      </a>
    </div>

    <div class="flex flex-col">
      <h1 :class="{ 'text-8xl': artist.name.length < nameLength, 'text-5xl': artist.name.length >= nameLength }"
          class="font-semibold m-0 leading-tight tracking-tighter">{{ artist.name }}</h1>
      <div class="font-medium text-sm">
        <span
            class="text-gray-400">{{ String(artist.followers.total).replace(/(.)(?=(\d{3})+$)/g,'$1,')  }} followers</span>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'Artist',
    props: {
      artist: Object,
      showCover: {
        type: Boolean,
        default: true,
      },
    },
    data() {
      return {
        nameLength: 30,
      }
    },
    methods: {},
    computed: {
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
  .media-object {
    @apply w-56;
  }
</style>
