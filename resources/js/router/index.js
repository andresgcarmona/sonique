import VueRouter from 'vue-router'
import Vue from 'vue'
import Dashboard from '../pages/Dashboard'
import Albums from '../pages/Albums'
import Album from '../pages/Album'
import Track from '../pages/Track'
import Playlists from '../pages/Playlists'
import Artist from '../pages/Artist'

// Use Vue router.
Vue.use(VueRouter)

// Create routes.
const router = new VueRouter({
  mode: 'history',
  scrollBehavior(to, from, savedPosition) {
    if(savedPosition) {
      return savedPosition
    }
    else {
      return {
        x: 0,
        y: 0,
      }
    }
  },
  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: Dashboard,
    }, {
      path: '/albums',
      name: 'albums',
      component: Albums,
    }, {
      path: '/album/:id',
      name: 'album.show',
      component: Album,
    }, {
      path: '/playlists',
      name: 'playlists',
      component: Playlists,
    }, {
      path: '/track/:id',
      name: 'track.show',
      component: Track,
    }, {
      path: '/artist/:id',
      name: 'artist.show',
      component: Artist,
    },
  ],
})

router.beforeEach((to, from, next) => {
  console.log(from, to)
  next()
})

export default router
