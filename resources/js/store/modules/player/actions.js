import { fetchPlayerInfo } from './api'
import { fetchDevices, pauseTrack as doPauseTrack, playTrack as doPlayTrack } from '../../api'

const getPlayerInfo = async({ commit }) => {
	try {
		const response = await fetchPlayerInfo()
		console.log(response)
		
		if(response && response.data) {
			commit('SET_CURRENT_PLAYING', response.data)
			
			return response.data
		}
		
		return null
	} catch(e) {
		console.error(e)
	}
}

const getDevices = async({ commit }) => {
	try {
		const { devices } = (await fetchDevices()).data
		
		commit('SET_DEVICES', devices)
		
		return devices
	} catch(error) {
		console.log(error)
	}
}

const playTrack = async({ commit }, payload) => {
	try {
		const response = await doPlayTrack(payload)
		
		commit('SET_CURRENT_TRACK', payload)
		
		return response
	} catch(error) {
		console.log(error)
	}
}

const pauseTrack = async({ commit }, payload) => {
	try {
		return await doPauseTrack(payload)
	} catch(error) {
		console.log(error)
	}
}

export default {
	getPlayerInfo,
	getDevices,
	playTrack,
	pauseTrack,
}
