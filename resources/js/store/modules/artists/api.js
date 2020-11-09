import axios from 'axios'

const fetchArtist = async(artist) => {
  try {
    return await axios.get(`/artist/${artist}`)
  } catch(e) {
    console.error(e)
    throw e
  }
}

const fetchAlbums = async(artist) => {
  try {
    return await axios.get(`/artist/${artist}/albums`)
  } catch(e) {
    console.error(e)
    throw e
  }
}

export {
  fetchArtist,
  fetchAlbums,
}
