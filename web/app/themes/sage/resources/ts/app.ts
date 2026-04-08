import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

import { accordion } from './components/accordion';

import.meta.glob(['../images/**', '../fonts/**']);

Alpine.plugin(focus);

// Initialize Window
window.Alpine = Alpine;

Alpine.data('accordion', accordion);

Alpine.start();
