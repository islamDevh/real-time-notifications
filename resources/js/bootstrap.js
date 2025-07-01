/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;
console.log("hello from bootstrap.js");

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});
// public channel
window.Echo.channel('new_user_channel')
    .listen('NewUserRegisterEvent',  // default event name space
    // .listen('App\\Events\\NewUserRegisterEvent',  // بخق ب
        (e) => { // e is the event data
            console.log(e.order);
            console.log('New User Registered:', e.user);
            // Get current count from the span
            const countElement = document.getElementById('notifCount');
            let currentCount = parseInt(countElement.textContent.trim()) || 0;

            // Increment count
            countElement.textContent = currentCount + 1;

        });

// private channel
// window.Echo.private('new_user_channel')
//     .listen('NewUserRegisterEvent',  // default event name space
//         (e) => { // e is the event data
//             console.log(e.order);
//             console.log('New User Registered:', e.user);
//             // Get current count from the span
//             const countElement = document.getElementById('notifCount');
//             let currentCount = parseInt(countElement.textContent.trim()) || 0;

//             // Increment count
//             countElement.textContent = currentCount + 1;

//         });

// presence channel
// window.Echo.join('admin_room_channel')
//     .here((users) => { // This callback is triggered when the user joins the channel and receives the list of users already in the channel
//         console.log('here Users currently in the channel:', users);
//     })
//     .joining((user) => { // This callback is triggered when a new user joins the channel
//         console.log('A new user has joined:', user);


//     })
//     .leaving((user) => {
//         console.log('A user has leaving:', user);

//     })
//     .error((error) => { // This callback is triggered when there is an error joining the channel
//         console.error('Error joining the channel:', error);
//     });
