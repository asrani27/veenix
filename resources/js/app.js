import './bootstrap';
import Uppy from '@uppy/core';
import Dashboard from '@uppy/dashboard';
import Tus from '@uppy/tus';

import '@uppy/core/dist/style.min.css';
import '@uppy/dashboard/dist/style.min.css';

//new Uppy().use(Dashboard, { inline: true, target: '#uppy' });

window.Uppy = Uppy;
window.Dashboard = Dashboard;
window.Tus = Tus;

if (document.getElementById('uppy')) {
    console.log(Uppy);
    var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    new window.Uppy()
        .use(Dashboard, { inline: true, target: '#uppy' })
        .use(Tus, {
            endpoint: 'http://localhost:8000/tus/',
            chunkSize: 2000000,
            headers: {
            'X-CSRF-TOKEN': csrf,
        } });
}

