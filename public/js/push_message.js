!function(t){function n(o){if(e[o])return e[o].exports;var i=e[o]={i:o,l:!1,exports:{}};return t[o].call(i.exports,i,i.exports,n),i.l=!0,i.exports}var e={};n.m=t,n.c=e,n.d=function(t,e,o){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:o})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},n.p="",n(n.s=1)}({1:function(t,n,e){t.exports=e("5jtu")},"5jtu":function(t,n){self.addEventListener("push",function(t){var n={body:"Another farmer has been attacked.",icon:"images/icons/icon-512x512.png",badge:"images/icons/icon-128x128.png",vibrate:[500,110,500,110],sound:"/sounds/9mm/mp3/9_mm.mp3",tag:"renotify",renotify:!0};t.waitUntil(self.registration.showNotification("Farm Attack",n))}),self.addEventListener("notificationclick",function(t){t.notification.close(),t.waitUntil(clients.openWindow("https://farmattacks.co.za"))})}});