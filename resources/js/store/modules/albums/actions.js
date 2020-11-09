import { fetchAlbum, fetchAlbums, fetchTracks } from './api'

const getAlbums = async({ commit, state }, url = '') => {
  try {
    const response = await fetchAlbums(state.request && state.request.next ? state.request.next : null)

    commit('SET_ALBUMS', { albums: response.data.items.items })

    delete response.data.items

    commit('SET_ALBUMS_REQUEST', { request: response.data })
  } catch(error) {
    console.log(error)
  }
}

const getAlbum = async({ commit }, id) => {
  try {
    const response = await fetchAlbum(id)

    commit('SET_ALBUM', { album: response.data })
  } catch(error) {
    console.error(error)
  }
}

const getTracks = async({ commit, state }, album) => {
  try {
    const response = await fetchTracks(album)

    commit('SET_ALBUMS_TRACKS', { tracks: response.data.items.items })

    delete response.data.items
  } catch(error) {
    console.log(error)
  }
}

export default {
  getAlbums,
  getAlbum,
  getTracks,
}
