import axios from 'axios'

const fetchPlayerInfo = async () => {
	try {
		return await axios.get('/player/info')
	}
	catch(e) {
		throw e
	}
}

export {
	fetchPlayerInfo,
}
