import { fetchPlaylists, fetchRecentlyPlayed, fetchDevices, playSong as doPlaySong } from './api'

const getPlaylists = async({ commit }) => {
  try {
    const response = await fetchPlaylists()

    commit('SET_PLAYLISTS', { playlists: response.data.items.items })
  } catch(error) {
    console.log(error)
  }
}

const getRecentlyPlayed = async({ commit }) => {
  try {
    const response = await fetchRecentlyPlayed()

    commit('SET_RECENTLY_PLAYED', { recentlyPlayed: response.data.items.items })
  } catch(error) {
    console.log(error)
  }
}

const getDevices = async({ commit }) => {
  try {
    return (await fetchDevices()).data.devices
  } catch(error) {
    console.log(error)
  }
}

const playSong = async({ commit }, payload) => {
  try {
    return (await doPlaySong(payload))
  } catch(error) {
    console.log(error)
  }
}

export default {
  getPlaylists,
  getRecentlyPlayed,
  getDevices,
  playSong,
}
