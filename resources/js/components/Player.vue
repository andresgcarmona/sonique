<template>
  <div class="player-container fixed bottom-0 z-50 w-full flex flex-col">
    <div class="progress progress-xs">
      <div class="progress-bar" role="progressbar"
           aria-valuenow="75"
           aria-valuemin="0"
           aria-valuemax="100"
           :style="{width: trackProgress + '%'}"></div>
    </div>
    
    <div class="flex p-4">
      <div class="song-metadata flex flex-1 items-center">
        <template v-if="currentTrack">
          <img :src="cover" alt="Album art" class="h-16 w-16 block mr-3"/>
          <div class="flex flex-col">
            <span>{{ artists }}</span>
            <span>{{ trackName }}</span>
          </div>
        </template>
      </div>
      <div class="flex flex-grow">
        <div class="media-controls flex items-center">
          <div class="media-button">
            <button class="btn btn-sm" @click="play(currentTrack)"><i class="fas fa-fw fa-step-backward fa-lg"></i>
            </button>
          </div>
          <div class="media-button mx-2">
            <button class="btn" v-if="!isPlaying" @click="play(currentTrack)"><i class="fas fa-fw fa-play fa-lg"></i>
            </button>
            <button class="btn" v-if="isPlaying" @click="pause"><i class="fas fa-fw fa-pause fa-lg"></i></button>
          </div>
          <div class="media-button">
            <button class="btn btn-sm" @click="play(currentTrack)"><i class="fas fa-fw fa-step-forward fa-lg"></i>
            </button>
          </div>
        </div>
      </div>
      
      <div class="flex-grow-0 flex items-center">
        <div>
          <span>{{ trackProgress }}</span>
          <span>-</span>
          <span>{{ trackDuration }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapActions, mapGetters, mapMutations } from 'vuex'
  import { find, padStart } from 'lodash'
  
  const PLAYER_INFO_INTERVAL = 5 * 1000 // 5 seconds.
  
  export default {
    name: 'Player',
    data() {
      return {
        songs: [],
        player: null,
        currentTrack: null,
        isPlaying: false,
        getPlayerInfoInterval: null,
        tickInterval: null,
        trackProgress: 0,
        progressMs: 0,
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
            
            deviceId = find(devices, device => {
              return device.name === 'Sonique player one'
            })
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
        
        this.tickInterval          = setInterval(this.updateTrackProgress, 1000)
        this.getPlayerInfoInterval = setInterval(this.updatePlayerInfo, PLAYER_INFO_INTERVAL)
      },
      async pause() {
        this.isPlaying = false
        
        const response = await this.pauseTrack({
          device: this.device,
        })
        
        this.getPlayerInfo()
        
        if(this.getPlayerInfoInterval) {
          clearInterval(this.getPlayerInfoInterval)
        }
        
        if(this.tickInterval) {
          clearInterval(this.tickInterval)
        }
      },
      async updatePlayerInfo() {
        //this.getPlayerInfo()

//        if(this.playerInfo) {
//          this.trackProgress = Math.floor((this.playerInfo.progress_ms / this.playerInfo.item.duration_ms) * 100)
//        }
      },
      updateTrackProgress() {
        if(this.currentTrack) {
          this.progressMs += 1000
          this.trackProgress = Math.floor((this.progressMs / this.currentTrack.duration_ms) * 100)
        }
        
        return 0
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
        let artists = ''
        
        if(this.currentTrack && this.currentTrack.artists.items) {
          this.currentTrack.artists.items[0].forEach(artist => artists += artist.name)
          
          return artists
        }
        
        this.currentTrack.artists.forEach(artist => artists += artist.name)
        
        return artists
      },
      cover() {
        return this.currentTrack.album.images[0].url
      },
      currentProgrees() {
        if(this.currentTrack) {
        }
      },
      trackDuration() {
        if(this.currentTrack) {
          const durationMs = this.currentTrack.duration_ms
          
          let minutes = Math.floor((durationMs / 1000 / 60))
          let seconds = Math.floor((durationMs / 1000) % 60)
          
          if(minutes > 60) {
            let hours = Math.floor(minutes / 60)
            
            return padStart(hours + '', 2, '00') + ' h ' + padStart(minutes + '', 2, '00') + ' min'
          }
          
          return padStart(minutes + '', 2, '00') + ':' + padStart(seconds + '', 2, '00')
        }
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
      playerInfo(info) {
        if(info) {
          this.currentTrack = info.item
        }
      },
    },
  }
</script>
