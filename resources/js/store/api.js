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

const fetchDevices = async() => {
  try {
    return await axios.get('/devices')
  } catch(e) {
    console.error(e)
    throw e
  }
}

const playSong = async({ device, uris }) => {
  try {
    return await axios.put(`/play?device_id=${device.id}`, {
      uris,
    })
  } catch(e) {
    console.error(e)
    throw e
  }
}

export {
  fetchRecentlyPlayed,
  fetchPlaylists,
  fetchDevices,
  playSong,
}
