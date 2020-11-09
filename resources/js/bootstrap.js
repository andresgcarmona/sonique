import $ from 'jquery'
import axios from 'axios'
import Popper from 'popper.js'
import './lib/bootstrap/dropdown'

window.$      = window.jQuery = $
window.Popper = Popper
window.axios  = axios

const token = document.head.querySelector('meta[name="csrf-token"]')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.headers.common['X-CSRF-TOKEN']     = token.content
window.axios.defaults.baseURL                            = '/api/'
