import { fetchAlbums, fetchArtist } from './api'

const getArtist = async({ commit, state }, track) => {
  try {
    const response = await fetchArtist(track)

    commit('SET_ARTIST', { artist: response.data })
  } catch(error) {
    console.log(error)
  }
}

const getAlbums = async({ commit, state }, track) => {
  try {
    const response = await fetchAlbums(track)

    commit('SET_ALBUMS', { albums: response.data.items.items })
  } catch(error) {
    console.log(error)
  }
}

export default {
  getArtist,
  getAlbums,
}
