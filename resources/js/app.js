import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

window.notyf = new Notyf({
    duration: 3000,
    position: { x: 'right', y: 'top' }
});