<template>
  <div class="player-container fixed bottom-0 z-50 p-4 w-full">
    <div class="song-metadata flex items-center"
         v-if="currentTrack">
      <img :src="cover" alt="Album art" class="h-16 w-16 block mr-3"/>
      <div class="media-controls mr-3">
        <div class="media-play-button">
          <button class="btn" v-if="!isPlaying" @click="play(currentTrack)"><i class="fas fa-fw fa-play fa-lg"></i>
          </button>
          <button class="btn" v-if="isPlaying" @click="pause"><i class="fas fa-fw fa-pause fa-lg"></i></button>
        </div>
      </div>
      <p>{{ artists }} - {{ trackName }}</p>
    </div>
  </div>
</template>

<script>
  import { mapActions, mapGetters, mapMutations } from 'vuex'
  
  export default {
    name: 'Player',
    data() {
      return {
        songs: [],
        player: null,
        currentTrack: null,
        isPlaying: false,
      }
    },
    methods: {
      ...mapMutations({
        setDevices: 'player/SET_DEVICES',
        setDevice: 'player/SET_DEVICE',
      }),
      
      ...mapActions({
        playTrack: 'player/playTrack',
        pauseTrack: 'player/pauseTrack',
        getDevices: 'player/getDevices',
        getPlayerInfo: 'player/getPlayerInfo',
      }),
      
      async initPlayer() {
        this.player = new Spotify.Player({
          name: 'Sonique player one',
          getOAuthToken: (callback) => {
            callback(window.access_token)
          },
          volume: 0.5,
        })
        
        // Error handling
        this.player.on('initialization_error', ({ message }) => {
          console.error(message)
        })
        this.player.on('authentication_error', ({ message }) => {
          console.error(message)
        })
        this.player.on('account_error', ({ message }) => {
          console.error(message)
        })
        this.player.on('playback_error', ({ message }) => {
          console.error(message)
        })
        
        // Playback status updates
        this.player.on('player_state_changed', state => {
          console.log(state)
        })
        
        // Ready
        this.player.addListener('ready', async({ deviceId }) => {
          if(!deviceId) {
            const devices = await this.getDevices()
            deviceId      = devices[0]
          }
          
          if(deviceId) {
            this.setDevice(deviceId)
          }
        })
        
        // Not Ready
        this.player.on('not_ready', ({ device_id }) => {
          console.log('Device ID has gone offline', device_id)
        })
        
        const response = await this.player.connect()
        if(response) {
          console.log('The Web Playback SDK successfully connected to Spotify!')
        }
      },
      
      setPlayList() {
      
      },
      addSong(song) {
        this.songs.push(song)
      },
      async play(track = null) {
        if(!track && this.currentTrack) {
          track = this.currentTrack
        }
        
        await this.playTrack({
          device: this.device,
          uris: [track.uri],
          position_ms: this.playerInfo ? this.playerInfo.progress_ms : 0,
        })
        
        this.currentTrack = track
        this.isPlaying    = true
        
        this.getPlayerInfo()
      },
      async pause() {
        this.isPlaying = false
        
        const response = await this.pauseTrack({
          device: this.device,
        })
        
        this.getPlayerInfo()
      },
    },
    computed: {
      ...mapGetters({
        device: 'player/device',
        playerInfo: 'player/playerInfo',
      }),
      
      trackName() {
        if(this.currentTrack) {
          return this.currentTrack.name
        }
      },
      artists() {
        if(this.currentTrack && this.currentTrack.artists.items) {
          let artists = ''
          this.currentTrack.artists.items[0].forEach(artist => artists += artist.name)
          
          return artists
        }
        
        this.currentTrack.artists.join(', ')
      },
      cover() {
        return this.currentTrack.album.images[0].url
      },
      
    },
    created() {
      window.onSpotifyWebPlaybackSDKReady = async() => {
        await this.initPlayer()
        await this.getPlayerInfo()
      }
    },
    watch: {
      currentTrack() {
        if(this.currentTrack) {
        
        }
      },
    },
  }
</script>
