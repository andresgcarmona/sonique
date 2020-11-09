const SET_ARTIST = (state, payload) => {
  state.artist = payload.artist
}

const SET_ALBUMS = (state, payload) => {
  state.albums = payload.albums
}

export default {
  SET_ARTIST,
  SET_ALBUMS,
}
