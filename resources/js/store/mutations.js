const SET_RECENTLY_PLAYED = (state, payload) => {
  state.recentlyPlayed = payload.recentlyPlayed
}

const SET_PLAYLISTS = (state, payload) => {
  state.playlists = payload.playlists
}

const SET_ACTIVE_SECTION = (state, payload) => {
  state.activeSection = payload.section
}

const SET_API_TOKEN = (state, token) => {
  state.apiToken = token
}

export default {
  SET_RECENTLY_PLAYED,
  SET_ACTIVE_SECTION,
  SET_PLAYLISTS,
  SET_API_TOKEN,
}
