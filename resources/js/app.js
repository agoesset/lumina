import './bootstrap';

import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

// Make Chart available globally for Livewire components
window.Chart = Chart;
