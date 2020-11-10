const SET_DEVICE = (state, device) => {
	state.device = device
}

const SET_DEVICES = (state, devices) => {
	state.devices = devices
}

const SET_CURRENT_PLAYING = (state, info) => {
	state.playerInfo = info
}

const SET_CURRENT_TRACK = (state, track) => {
	state.currentTrack = track
}

export default {
	SET_DEVICE,
	SET_DEVICES,
	SET_CURRENT_PLAYING,
	SET_CURRENT_TRACK,
}
