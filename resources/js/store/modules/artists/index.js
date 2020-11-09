import actions from './actions'
import mutations from './mutations'
import getters from './getters'

const state = {
  artist: null,
  albums: [],
  tracks: [],
}

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
}
