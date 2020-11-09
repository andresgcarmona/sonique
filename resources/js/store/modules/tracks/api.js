import axios from 'axios'

const fetchTrack = async(track) => {
  try {
    return await axios.get(`/track/${track}`)
  } catch(e) {
    console.error(e)
    throw e
  }
}

export {
  fetchTrack,
}
