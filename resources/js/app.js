import './bootstrap'
import Vue from 'vue'
import store from './store'
import router from './router'
import VueMq from 'vue-mq'
import { mapMutations } from 'vuex'
import Sidebar from './components/Sidebar'

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
	},
	methods: {
		...mapMutations(['SET_RECENTLY_PLAYED', 'SET_API_TOKEN']),
	},
	created() {
		if(window.api_token) {
			this['SET_API_TOKEN'](window.api_token)
			
			window.axios.defaults.headers.common['Authorization'] = `Bearer ${window.api_token}`
		}
	},
	mounted() {
		// Set recently played tracks.
		if(window.recently_played) {
			this['SET_RECENTLY_PLAYED']({ recentlyPlayed: window.recently_played.items.items })
		}
	},
}).$mount('.app')
