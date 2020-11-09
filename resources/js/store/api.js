import axios from 'axios'

const fetchRecentlyPlayed = async() => {
  try {
    return await axios.get('/recently-played')
  } catch(e) {
    console.error(e)
    throw e
  }
}

const fetchPlaylists = async() => {
  try {
    return await axios.get('/playlists')
  } catch(e) {
    console.error(e)
    throw e
  }
}

export {
  fetchRecentlyPlayed,
  fetchPlaylists,
}
