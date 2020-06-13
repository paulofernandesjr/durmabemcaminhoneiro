import firebase from 'firebase'
// import { firebaseApp, SimplifyUser } from 'src/boot/firebase'
import { firebaseApp } from 'src/boot/firebase'

export default ({ router, store, Vue }) => {
  // verificar autenticacao em cada rota
  router.beforeEach((to, from, next) => {
    const authRequired = to.matched.some(route => route.meta.authRequired)
    const adminRequired = to.matched.some(route => route.meta.adminRequired)

    const currentUser = firebase.auth().currentUser
    if (currentUser !== null && currentUser.uid !== store.getters['auth/user'].uid) {
      // TODO: pode ser que tenha que tratar aqui
      console.log('ERRO: mudou UID!!!')
    }

    const isAuthenticated = store.getters['auth/isAuthenticated']
    const isAdmin = store.getters['auth/isAdmin']

    if (authRequired) {
      if (isAuthenticated) {
        if (!adminRequired || isAdmin) {
          // User is already signed in or admin. Continue on.
          next()
        } else {
          // Not admin
          next({
            path: '/'
          })
        }
      } else {
        // Not signed in. Redirect to login page.
        console.log('AUTHENTICATION REQUIRED!', to)
        next({
          path: '/',
          query: {
            redirect: to.fullPath
          }
          // TODO: incluir redirect
        })
      }
    } else {
      // Doesn't require authentication. Just continue on.
      next()
    }
  })

  // verificar mudanca de autenticacao para o boot e propagar no state
  firebaseApp.auth().onAuthStateChanged(async user => {
    // const simpleUser = await SimplifyUser(user)
    if (user) {
      // Signed in. Let Vuex know.
      // let roles = await db.collection('declarefacil').doc(simpleUser.uid)
      //   .get().then((doc) => {
      //     let data = doc.data()
      //     return {
      //       isQualifiedIrpf: (data.allowed_services && data.allowed_services.includes('irpf')) || false,
      //       isAdmin: (data.roles && data.roles.indexOf('admin') >= 0) || false
      //     }
      //   })
      // store.commit('auth/SET_USER', simpleUser)
      // store.commit('auth/SET_ADMIN', roles.isAdmin)
      // store.commit('auth/SET_QUALIFIED', roles.isQualifiedIrpf)
    } else {
      // Signed out. Let Vuex know.
      console.log('SIGNED OUT!!! <<<<<<<<')
      // store.commit('auth/RESET_USER')
      // router.replace({
      //   path: '/'
      //   // TODO: incluir redirect
      // })
    }
    // ocultar o loader
    // store.commit('base/MANAGER_LOADER', false)
  })
}
