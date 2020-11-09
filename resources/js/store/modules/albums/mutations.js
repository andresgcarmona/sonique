const SET_ALBUMS = (state, payload) => {
  state.albums = state.albums.length ? state.albums.concat(payload.albums) : payload.albums
}

const SET_ALBUM = (state, payload) => {
  state.album = payload.album
}

const SET_ALBUMS_REQUEST = (state, payload) => {
  state.request = payload.request
}

const SET_ALBUMS_TRACKS = (state, payload) => {
  state.tracks = payload.tracks
}

export default {
  SET_ALBUMS,
  SET_ALBUM,
  SET_ALBUMS_REQUEST,
  SET_ALBUMS_TRACKS,
}
