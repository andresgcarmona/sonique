const SET_DEVICE = (state, device) => {
	state.device = device
}

const SET_DEVICES = (state, devices) => {
	state.devices = devices
}

const SET_CURRENT_PLAYING = (state, info) => {
	state.playerInfo = info
}

export default {
	SET_DEVICE,
	SET_DEVICES,
	SET_CURRENT_PLAYING,
}
