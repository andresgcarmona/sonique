import './bootstrap'
import Vue from 'vue'
import store from './store'
import router from './router'
import VueMq from 'vue-mq'
import { mapActions, mapMutations } from 'vuex'
import Sidebar from './components/Sidebar'
import Player from './components/Player'

// Do not parse these elements.
Vue.config.ignoredElements = ['date', 'time', 'track']
Vue.config.productionTip   = false

Vue.use(VueMq, {
	xs: 0,
	sm: 576,
	md: 768,
	lg: 992,
	xl: 1200,
})

new Vue({
	store,
	router,
	components: {
		Sidebar,
		Player,
	},
	data() {
		return {
			player: null,
			devices: [],
		}
	},
	methods: {
		...mapMutations(['SET_RECENTLY_PLAYED', 'SET_API_TOKEN']),
		
		...mapActions({
			getDevices: 'getDevices',
			playSong: 'playSong',
		}),
		
		async play(device) {
			const spotify_uri = 'spotify:track:3IFwTN0soeB6vzf49vYNc6'

			await this.playSong({
				device,
				uris: [spotify_uri],
			})
//			this.$refs.player.addSong({
//				'name': 'Risin\' High (feat Raashan Ahmad)',
//				'artist': 'Ancient Astronauts',
//				'album': 'We Are to Answer',
//				'url': 'https://api.spotify.com/v1/tracks/3IFwTN0soeB6vzf49vYNc6',
//				'cover_art_url': 'https://i.scdn.co/image/ab67616d0000b2739c61c0550df89c60580d1231',
//			})

			this.$refs.player.play()
		},
		
		async initPlayer() {
			this.player = new Spotify.Player({
				name: 'Sonique player one',
				getOAuthToken: (callback) => {
					callback(window.access_token)
				},
				volume: 0.5,
			})
			
			const response = await this.player.connect()
			if(response) {
				console.log('The Web Playback SDK successfully connected to Spotify!')
				
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
				this.player.addListener('ready', async ({ device_id }) => {
					console.log('Ready with Device ID', device_id)
					
					const devices = await this.getDevices()
					
					console.log(devices)
					if(devices.length) {
						await this.play(devices[0])
						
						this.player.getCurrentState().then(state => {
							if(!state) {
								console.error('User is not playing music through the Web Playback SDK')
								return
							}
							
							let {
								    current_track,
								    next_tracks: [next_track],
							    } = state.track_window
							
							console.log('Currently Playing', current_track)
							console.log('Playing Next', next_track)
						})
					}
				})
				
				// Not Ready
				this.player.on('not_ready', ({ device_id }) => {
					console.log('Device ID has gone offline', device_id)
				})
			}
		},
	},
	async created() {
		if(window.api_token) {
			this['SET_API_TOKEN'](window.api_token)
			
			window.axios.defaults.headers.common['Authorization'] = `Bearer ${window.api_token}`
		}
		
		window.onSpotifyWebPlaybackSDKReady = () => {
			this.initPlayer()
		}
	},
	mounted() {
		// Set recently played tracks.
		if(window.recently_played) {
			this['SET_RECENTLY_PLAYED']({ recentlyPlayed: window.recently_played.items.items })
		}
	},
}).$mount('.app')
