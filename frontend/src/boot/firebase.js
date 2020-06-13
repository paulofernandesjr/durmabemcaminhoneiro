import Vue from 'vue'
import Firebase from 'firebase/app'
import firebaseConfig from 'src/firebase.conf'
import 'firebase/auth'
import * as firebaseui from 'firebaseui__pt_br'

const firebaseApp = Firebase.initializeApp(firebaseConfig)

// Configure Firestore
// DEPRECATED: Firebase.firestore().settings({ timestampsInSnapshots: true })

const firebaseAppAuth = firebaseApp.auth()
firebaseAppAuth.languageCode = 'pt-BR'
const GoogleAuthProvider = new Firebase.auth.GoogleAuthProvider()
GoogleAuthProvider.addScope('https://www.googleapis.com/auth/userinfo.email')

Vue.prototype.$auth = firebaseAppAuth
Vue.prototype.$firebase = Firebase

Vue.prototype.$ui = new firebaseui.auth.AuthUI(firebaseAppAuth)
Vue.prototype.$firebaseui = firebaseui

const emailAuthenticationExists = async (email) => {
  const result = await firebaseAppAuth.fetchSignInMethodsForEmail(email)
    .then((signInMethods) => {
      return signInMethods
      // $firebase.auth.EmailAuthProvider.EMAIL_PASSWORD_SIGN_IN_METHOD
      // firebase.auth.EmailAuthProvider.EMAIL_PASSWORD_SIGN_IN_METHOD) != -1) {
      // firebase.auth.EmailAuthProvider.EMAIL_LINK_SIGN_IN_METHOD) != -1) {
    })
    .catch(() => {
      return []
    })
  return result
}
Vue.prototype.$emailAuthenticationExists = emailAuthenticationExists

const SimplifyUser = async (fUser) => {
  if (!fUser) {
    return {}
  }
  return {
    uid: fUser.uid,
    displayName: fUser.displayName,
    email: fUser.email,
    emailVerified: fUser.emailVerified,
    photoURL: fUser.photoURL,
    phoneNumber: fUser.phoneNumber,
    lastSignInTime: fUser.metadata.lastSignInTime,
    creationTime: fUser.metadata.creationTime,
    provider: fUser.providerData[0].providerId
  }
}
Vue.prototype.$simplifyUser = SimplifyUser

export {
  firebaseApp,
  firebaseAppAuth,
  SimplifyUser,
  emailAuthenticationExists,
  GoogleAuthProvider
}
