import './bootstrap';
import './mapBox.js';
import '../../vendor/masmerise/livewire-toaster/resources/js';
import 'livewire-sortable';

import {marked} from 'marked';
import DOMPurify from 'dompurify';

window.marked = marked;
window.DOMPurify = DOMPurify;
