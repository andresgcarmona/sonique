<template>
  <div class="player-container fixed bottom-0 bg-red-800 z-50 p-4 w-full">
    <div class="song-metadata flex items-center">
      <p>Plastic - Extended Mix</p>
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
      }
    },
    methods: {
      ...mapMutations({
        setDevices: 'player/SET_DEVICES',
        setDevice: 'player/SET_DEVICE',
      }),
      
      ...mapActions({
        playSong: 'player/playSong',
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
      async play(uri) {
        await this.playSong({
          device: this.device,
          uris: [uri],
        })
      },
    },
    computed: {
      ...mapGetters({
        device: 'player/device',
      }),
    },
    created() {
      window.onSpotifyWebPlaybackSDKReady = async() => {
        await this.initPlayer()
        await this.getPlayerInfo()
      }
    },
  }
</script>
