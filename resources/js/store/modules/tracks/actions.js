import { fetchTrack } from './api'

const getTrack = async({ commit, state }, track) => {
  try {
    const response = await fetchTrack(track)

    commit('SET_TRACK', { track: response.data })
  } catch(error) {
    console.log(error)
  }
}

export default {
  getTrack,
}
