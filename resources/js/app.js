import.meta.glob([
  '../images/**',
  '../fonts/**',
]);
import './bootstrap';
import {
  Toast,
  Ripple,
  initTE,
} from 'tw-elements';
import './toggle-password.js';

/** Toast Handler */
const toastList = [].slice.call(
    document.querySelectorAll('[data-te-container="toast"]')
);

toastList.map((toastItem) => {
  Toast.getOrCreateInstance(toastItem).show();

  setTimeout(() => {
    Toast.getOrCreateInstance(toastItem).hide();
  }, 3000);
});

initTE({ Ripple });
