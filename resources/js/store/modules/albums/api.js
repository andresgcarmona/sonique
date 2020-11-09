import axios from 'axios'

const fetchAlbums = async(url = '') => {
  try {
    return await axios.get('/albums', {
      params: {
        url,
      },
    })
  } catch(e) {
    console.error(e)
    throw e
  }
}

const fetchAlbum = async(id) => {
  try {
    return await axios.get(`/album/${id}`)
  } catch(e) {
    console.error(e)
    throw e
  }
}

const fetchTracks = async(id) => {
  try {
    return await axios.get(`/album/${id}/tracks`)
  } catch(e) {
    console.error(e)
    throw e
  }
}

export {
  fetchAlbums,
  fetchAlbum,
  fetchTracks,
}
