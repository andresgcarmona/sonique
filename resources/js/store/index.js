import Vuex from 'vuex'
import Vue from 'vue'
import actions from './actions'
import mutations from './mutations'
import getters from './getters'
import albums from './modules/albums'
import tracks from './modules/tracks'
import artists from './modules/artists'

Vue.use(Vuex)

const state = {
  recentlyPlayed: [], // Recently played tracks.
  albums: [],
  playlists: [],
  activeSection: null,
  apiToken: null,
}

export default new Vuex.Store({
  state,
  actions,
  mutations,
  getters,
  modules: {
    albums,
    tracks,
    artists,
  },
})
