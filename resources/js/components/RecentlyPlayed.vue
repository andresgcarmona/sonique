<template>
    <media-object-list :items="items"
                       :max-items="maxItems"
                       :title="title">
    </media-object-list>
</template>

<script>
  import MediaObjectList from './MediaObjectList'

  export default {
      name: 'RecentlyPlayed',
      props: {
          title: {
              type: String,
              default: '',
          },
          maxItems: {
              type: Number,
              default: -1,
          },
            items: Array,
        },
        components: {
            MediaObjectList,
        },
    }
</script>
