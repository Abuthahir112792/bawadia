import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
const store = new Vuex.Store({
    state: {
        counter: 100,
        authUser: window.authUser,
        setting: window.setting,
        load: false,
        token: localStorage.getItem('token') || null,
        firebasetoken: localStorage.getItem('firebasetoken') || null,
        notifications: [],
        firebaseConfig: {
            apiKey: "AIzaSyD3GUsWOwqE_VlsYr7IfiT1ND-wfrC7Jes",
            authDomain: "bouvardia-a8aef.firebaseapp.com",
            databaseURL: "https://bouvardia-a8aef.firebaseio.com",
            projectId: "bouvardia-a8aef",
            storageBucket: "bouvardia-a8aef.appspot.com",
            messagingSenderId: "69359464073",
            appId: "1:69359464073:web:35b9643e74cf5516ed6058",
            measurementId: "G-LL0S5YB9SZ"
        },
        // apiKey: "AIzaSyCvqh6umEvDgfvo1WUpvcJWUyFk7nfz7xE",
        // authDomain: "fabios-9930c.firebaseapp.com",
        // databaseURL: "https://fabios-9930c.firebaseio.com",
        // projectId: "fabios-9930c",
        // storageBucket: "fabios-9930c.appspot.com",
        // messagingSenderId: "1084187045210",
        // appId: "1:1084187045210:web:1127e46b483934af939763",
        // measurementId: "G-C72P5EETL8"
    //     apiKey: "AIzaSyD3GUsWOwqE_VlsYr7IfiT1ND-wfrC7Jes",
    // authDomain: "bouvardia-a8aef.firebaseapp.com",
    // databaseURL: "https://bouvardia-a8aef.firebaseio.com",
    // projectId: "bouvardia-a8aef",
    // storageBucket: "bouvardia-a8aef.appspot.com",
    // messagingSenderId: "69359464073",
    // appId: "1:69359464073:web:35b9643e74cf5516ed6058",
    // measurementId: "G-LL0S5YB9SZ"
    },

    /*All getters*/
    getters: {
        getCounter(state) {
            return state.counter
        },
        isLoggedIn(state) {
            if (_.isEmpty(state.authUser)) {
                return false
            } else {
                return true
            }

        },
        loggedInUser(state) {
            return state.authUser
        },
        load(state) {
            return state.load
        },
        noti(state) {
            return state.notifications
        },
    },

    /*all mutations*/
    mutations: {
        update(state, data) {
            state.counter++
        },
        user(state, user) {
            state.authUser = user
        },
        setting(state, setting) {
            state.setting = setting
        },

    },

    /*all actions*/
    actions: {
        update({ commit }, data) {
            commit('update', data)
        },
        user({ commit }, user) {
            commit('user', user)
        },


    }
})

export default store