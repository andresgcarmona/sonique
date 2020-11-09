<template>
  <media-object-list :items="albums"
                     :title="title"
                     ref="media-object-list">

  </media-object-list>
</template>

<script>
  import MediaObjectList from './MediaObjectList'

  export default {
    name: 'AlbumsList',
    data() {
      return {
        loading: false,
      }
    },
    props: {
      title: {
        type: String,
        default: '',
      },
      albums: Array,
    },
    components: {
      MediaObjectList,
    },
  }
</script>
