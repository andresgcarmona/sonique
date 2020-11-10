import actions from './actions'
import mutations from './mutations'
import getters from './getters'

const state = {
	device: null,
	devices: [],
	playerInfo: null,
	currenTrack: null,
}

export default {
	namespaced: true,
	state,
	actions,
	mutations,
	getters,
}
