import.meta.glob([
  '../images/**',
  '../fonts/**',
]);
import './bootstrap';
import { 
  Ripple,
  initTE,
} from 'tw-elements';
import './toggle-password.js';

initTE({ Ripple });
