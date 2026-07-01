import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const wsHost = (import.meta.env.VITE_REVERB_HOST ?? window.location.hostname).replace(/['"]/g, '');
const wsPort = String(import.meta.env.VITE_REVERB_PORT ?? 8080).replace(/['"]/g, '');
const scheme = (import.meta.env.VITE_REVERB_SCHEME ?? 'http').replace(/['"]/g, '');

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: (import.meta.env.VITE_REVERB_APP_KEY ?? '').replace(/['"]/g, ''),
    wsHost: wsHost,
    wsPort: wsPort ? parseInt(wsPort, 10) : 8080,
    wssPort: wsPort ? parseInt(wsPort, 10) : 8080,
    forceTLS: scheme === 'https',
    enabledTransports: ['ws', 'wss'],
});
