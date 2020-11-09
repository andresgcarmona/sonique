<template>
    <media-object-list :items="playlists"
                       :title="title"
                       ref="media-object-list">

    </media-object-list>
</template>

<script>
    import MediaObjectList from './MediaObjectList'

    export default {
        name: 'PlaylistsList',
        props: {
            title: {
                type: String,
                default: '',
            },
            playlists: Array,
        },
        components: {
            MediaObjectList,
        },
    }
</script>
