<template>
  <div class="media-object-list-container max-w-full mx-auto px-2 md:px-8 py-4 mt-2">
    <header class="section-title w-full">
      <div class="flex flex-col md:flex-row">
        <div class="lead w-full mb-4">
          <span class="h3 text-2xl font-medium m-0">{{ title }}</span>
        </div>
      </div>
    </header>

    <div
        class="media-object-list grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-6 gap-3 md:gap-3 lg:gap-3 flex justify-center">
      <div :item="item"
           :key="item.id"
           @media-object-selected="mediaObjectSelected"
           is="media-object"
           v-for="item in items"></div>
    </div>
  </div>
</template>

<script>
  import MediaObject from './MediaObject'

  export default {
    name: 'MediaObjectList',
    props: {
      title: {
        type: String,
        default: '',
      },
      items: Array,
      maxItems: {
        type: Number,
        default: -1,
      },
    },
    data() {
      return {
        filteredItems: [],
      }
    },
    methods: {
      mediaObjectSelected() {

      },
    },
    components: {
      MediaObject,
    },
  }
</script>
