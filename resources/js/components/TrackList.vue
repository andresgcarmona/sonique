<template>
  <div class="track-list px-2 md:px-8">
    <ol class="tracks">
      <li :key="track.id"
          class="track pr-2 pl-12 py-3 cursor-pointer transition duration-200" v-for="track in tracks">
        <div class="flex w-full relative items-center">
          <div class="absolute track-icon">
            <i class="fas fa-music"></i>
            <i class="fas fa-play"></i>
          </div>
          <div class="flex-grow flex flex-col">
            <div class="track-name text-base text-white">{{ track.name }}</div>
            <div class="track-artists text-sm text-gray-400">
              <a :key="artist.id"
                 class="text-sm text-gray-400"
                 href="#" v-for="(artist, index) in trackArtists(track)">
                {{ artist.name }}{{ index < trackArtists(track).length - 1 ? ', ' : ''}}
              </a>
            </div>
          </div>
          <div class="text-sm">
            {{ duration(track.duration_ms) }}
          </div>
        </div>
      </li>
    </ol>
  </div>
</template>
<script>
  import { padStart } from 'lodash'

  export default {
    name: 'TrackList',
    props: {
      tracks: Array,
    },
    methods: {
      duration(durationMs) {
        if(durationMs) {
          let minutes = Math.floor((durationMs / 1000 / 60))
          let seconds = Math.floor((durationMs / 1000) % 60)

          if(minutes > 60) {
            let hours = Math.floor(minutes / 60)

            return padStart(hours + '', 2, '00') + ' h ' + padStart(minutes + '', 2, '00') + ' min'
          }

          return padStart(minutes + '', 2, '00') + ':' + padStart(seconds + '', 2, '00')
        }
      },
      trackArtists(track) {
        if(track.artists.items && track.artists.items['0']) {
          return track.artists.items['0']
        }

        return track.artists
      },
    },
    computed: {},
  }
</script>
<style lang="scss" scoped>
  .track-list {
    .tracks {
      .track {
        &:hover {
          background-color: hsla(0, 0%, 100%, .1);

          .track-icon {
            .fa-play {
              display: inline-block;
            }

            .fa-music {
              display: none;
            }
          }
        }

        .track-icon {
          margin-left: -2rem;

          .fa-play {
            display: none;
          }
        }
      }
    }
  }
</style>
