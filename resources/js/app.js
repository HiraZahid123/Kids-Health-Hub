import './bootstrap';

import Alpine from 'alpinejs';
import providerCoverCard from './provider-card-editor';

window.Alpine = Alpine;

Alpine.data('providerCoverCard', providerCoverCard);

Alpine.start();
