importScripts('https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.5.0/firebase-messaging.js');
const firebaseConfig = {
  apiKey: "AIzaSyD3GUsWOwqE_VlsYr7IfiT1ND-wfrC7Jes",
  authDomain: "bouvardia-a8aef.firebaseapp.com",
  databaseURL: "https://bouvardia-a8aef.firebaseio.com",
  projectId: "bouvardia-a8aef",
  storageBucket: "bouvardia-a8aef.appspot.com",
  messagingSenderId: "69359464073",
  appId: "1:69359464073:web:35b9643e74cf5516ed6058",
  measurementId: "G-LL0S5YB9SZ"
};  
    var listener = new BroadcastChannel('listener');
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    messaging.setBackgroundMessageHandler(function(payload) {
      console.log('test2', payload);
      // Customize notification here
      const notificationTitle = payload.data.title;
      const notificationOptions = {
        body: payload.data.message,
        icon: '/Icon-TasTaz.png',
      };

      listener.postMessage(payload.data.id);
      return self.registration.showNotification(notificationTitle,
        notificationOptions);
    });
