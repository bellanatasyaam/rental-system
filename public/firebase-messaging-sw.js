// public/firebase-messaging-sw.js
importScripts("https://www.gstatic.com/firebasejs/10.7.1/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging-compat.js");

const firebaseConfig = {
  apiKey: "AIzaSyCJOANDFcHCxQbdRE80toyI1RjxpHMZ87Q",
  authDomain: "rental-system-833a9.firebaseapp.com",
  projectId: "rental-system-833a9",
  storageBucket: "rental-system-833a9.firebasestorage.app",
  messagingSenderId: "121485908783",
  appId: "1:121485908783:web:ce0be2285988d021df1fda",
  measurementId: "G-HNJKB85YH8"
};

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

// 🔹 Listener untuk pesan background (saat tab tertutup / di background)
messaging.onBackgroundMessage((payload) => {
  console.log("📩 Pesan background diterima:", payload);
  self.registration.showNotification(payload.notification.title, {
    body: payload.notification.body,
    icon: "/firebase-logo.png" // optional, ganti sesuai logo kamu
  });
});
