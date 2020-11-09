import actions from './actions'
import mutations from './mutations'
import getters from './getters'

const state = {
  albums: [],
  album: null,
  request: null,
  tracks: [],
}

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
}
