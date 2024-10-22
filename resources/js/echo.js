import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});


window.Echo.channel('user-added')
.listen('UserAdded', (e) => {
    console.log(e);
    const userName = e.name;
    const userMail = e.email;
    const userBox = document.getElementById('userBox');

    const userList = document.createElement('tr');
    userList.innerHTML = `
    <td class="border border-slate-700 p-6">${userName}</td>
    <td class="border border-slate-700 p-6">${userMail}</td>
    `;
    userBox.appendChild(userList);
});