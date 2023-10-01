import.meta.glob([
  '../images/**',
  '../fonts/**',
]);
import './bootstrap';
import { 
  Ripple, 
  initTE,
} from 'tw-elements';

initTE({ Ripple });
