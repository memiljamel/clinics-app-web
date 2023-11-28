import.meta.glob([
  '../images/**',
  '../fonts/**',
]);
import {
  Validation,
  Select,
  Datepicker,
  Input,
  Offcanvas,
  Collapse,
  Dropdown,
  Tooltip,
  PerfectScrollbar,
  Toast,
  initTE,
} from 'tw-elements';
import clsx from 'clsx';
import './bootstrap';
import './toggle-password';
import './preview-image';
import './autosize';
import {
  teCustomErrorMessage,
  teCustomRules,
} from './custom-rules';

/** Tooltip Handler */
const tooltipList = [].slice.call(
  document.querySelectorAll('[data-te-toggle="tooltip"]')
);

tooltipList.map((tooltipItem) => {
  return new Tooltip(tooltipItem, {
    placement: 'bottom',
    template: `
      <div class="z-30" role="tooltip">
        <div class="tooltip-inner inline-block bg-dark-charcoal text-white font-medium rounded caption min-h-[14px] px-2 py-1 dark:bg-lotion dark:text-black"></div>
      </div>
    `,
    offset: ({placement, reference, popper}) => {
      if (placement === 'bottom') {
        return [0, 0];
      } else {
        return [0, 8];
      }
    },
    trigger: 'hover',
    boundary: 'window',
  });
});

/** Toast Handler */
const toastList = [].slice.call(
  document.querySelectorAll('[data-te-toast-init]')
);

toastList.map((toastItem) => {
  setTimeout(() => {
    Toast.getOrCreateInstance(toastItem).hide();
  }, 3000);
});

/** Dropdown Handler */
const dropdownList = [].slice.call(
  document.querySelectorAll('[data-te-dropdown-toggle-ref]')
)

dropdownList.map((dropdownItem) => {
  return new Dropdown(dropdownItem, {
    popperConfig: {
      strategy: 'fixed',
    },
  });
});

/** PerfectScrollbar Handler */
const scrollList = [].slice.call(
  document.querySelectorAll('[data-te-perfect-scrollbar-init]')
);

scrollList.map((scrollItem) => {
  return new PerfectScrollbar(scrollItem, {}, {
    railX:
      'group/x absolute bottom-0 h-2.5 hidden opacity-0 transition-[background-color,_opacity] duration-200 ease-linear motion-reduce:transition-none z-0 group-[&.ps--active-x]/ps:block group-hover/ps:opacity-60 group-focus/ps:opacity-60 group-[&.ps--scrolling-x]/ps:opacity-60 hover:!opacity-90 focus:!opacity-90 [&.ps--clicking]:!opacity-90 outline-none',
    railXThumb:
      'absolute bottom-0.5 rounded-md h-1.5 group-focus/ps:opacity-100 group-active/ps:opacity-100 [transition:background-color_.2s_linear,_height_.2s_ease-in-out] group-hover/x:h-1.5 group-focus/x:h-1.5 group-[&.ps--clicking]/x:bg-[#999] group-[&.ps--clicking]/x:h-1.5 outline-none',
    railY:
      'group/y absolute right-0 w-2.5 hidden opacity-0 transition-[background-color,_opacity] duration-200 ease-linear motion-reduce:transition-none z-0 group-[&.ps--active-y]/ps:block group-hover/ps:opacity-60 group-focus/ps:opacity-60 group-[&.ps--scrolling-y]/ps:opacity-60 hover:!opacity-90 focus:!opacity-90 [&.ps--clicking]:!opacity-90 outline-none',
    railYThumb:
      'absolute right-0.5 rounded-md w-1.5 group-focus/ps:opacity-100 group-active/ps:opacity-100 [transition:background-color_.2s_linear,_width_.2s_ease-in-out,_opacity] group-hover/y:w-1.5 group-focus/y:w-1.5 group-[&.ps--clicking]/y:w-1.5 outline-none',
  });
});

/** Collapse Handler */
const ctrCollapseList = [].slice.call(
  document.querySelectorAll('[data-te-collapse-item]')
);

const btnCollapseList = [].slice.call(
  document.querySelectorAll('[data-te-collapse-init]')
);

ctrCollapseList.map((ctrCollapseItem, index) => {
  ctrCollapseItem.addEventListener('shown.te.collapse', () => {
    btnCollapseList[index].innerText = 'Hide more';
  });

  ctrCollapseItem.addEventListener('hidden.te.collapse', () => {
    btnCollapseList[index].innerText = 'Show more';
  });
});

/** Input Handler */
const inputList = [].slice.call(
  document.querySelectorAll('[data-te-input-wrapper-init]')
);

inputList.map((inputItem, index) => {
  const isFieldValid = Boolean(errors.includes(inputItem.children[0].name));

  return new Input(inputItem, {}, {
    notch:
      clsx("group flex w-full max-w-full h-full text-left select-none pointer-events-none absolute transition-all top-0 after:content[''] after:block after:w-full after:absolute after:bottom-0 left-0 after:border-b-2 after:transition-transform after:duration-300 after:scale-x-0 after:border-primary peer-focus:after:scale-x-100 peer-focus:after:border-primary peer-data-[te-input-focused]:after:scale-x-100 peer-data-[te-input-focused]:after:border-primary group-data-[te-validation-state='invalid']:after:!border-error", {
        'after:!border-error peer-focus:after:!border-error peer-data-[te-input-focused]:after:!border-error': isFieldValid,
      }),
    notchLeading:
      'pointer-events-none border-b border-solid box-border bg-transparent transition-none duration-0 left-0 top-0 h-full w-0 border-r-0 rounded-l-none group-data-[te-input-focused]:border-r-0 group-data-[te-input-state-active]:border-r-0 peer-disabled:group-[]:border-dotted',
    notchLeadingNormal:
      clsx('border-black/[0.24] dark:border-white/[0.24] group-data-[te-input-focused]:shadow-none group-data-[te-input-focused]:border-black/[0.24] dark:group-data-[te-input-focused]:border-white/[0.24]', {
        '!border-error dark:!border-error': isFieldValid,
      }),
    notchMiddle:
      'pointer-events-none border-b border-solid box-border bg-transparent transition-none duration-0 grow-0 shrink-0 basis-auto w-auto max-w-[calc(100%-1rem)] h-full border-r-0 border-l-0 group-data-[te-input-focused]:border-x-0 group-data-[te-input-state-active]:border-x-0 group-data-[te-input-focused]:border-t-0 group-data-[te-input-state-active]:border-t-0 group-data-[te-input-focused]:border-solid group-data-[te-input-state-active]:border-solid group-data-[te-input-focused]:border-t-transparent group-data-[te-input-state-active]:border-t-transparent peer-disabled:group-[]:border-dotted',
    notchMiddleNormal:
      clsx('border-black/[0.24] dark:border-white/[0.24] group-data-[te-input-focused]:shadow-none group-data-[te-input-focused]:border-black/[0.24] dark:group-data-[te-input-focused]:border-white/[0.24]', {
        '!border-error dark:!border-error': isFieldValid,
      }),
    notchTrailing:
      'pointer-events-none border-b border-solid box-border bg-transparent transition-none duration-0 grow h-full border-l-0 rounded-r-none group-data-[te-input-focused]:border-l-0 group-data-[te-input-state-active]:border-l-0 peer-disabled:group-[]:border-dotted',
    notchTrailingNormal:
      clsx('border-black/[0.24] dark:border-white/[0.24] group-data-[te-input-focused]:shadow-none group-data-[te-input-focused]:border-black/[0.24] dark:group-data-[te-input-focused]:border-white/[0.24]', {
        '!border-error dark:!border-error': isFieldValid,
      }),
  });
});

/** Select Handler */
const selectList = [].slice.call(
  document.querySelectorAll('[data-te-select-init]')
);

selectList.map((selectItem) => {
  const isFieldValid = Boolean(errors.includes(selectItem.name));

  return new Select(selectItem, {
    selectOptionHeight: 40,
  }, {
    selectInput:
      'peer block min-h-[48px] w-full border-0 bg-transparent pt-3 pb-2 subtitle-1 text-black/[0.87] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-white/[0.87] dark:placeholder:text-white/[0.87] [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0 disabled:opacity-60 disabled:cursor-not-allowed',
    selectInputSizeDefault:
      'p-0 m-0 leading-[1.6]',
    selectLabel:
      clsx("pointer-events-none absolute top-0 left-0 mb-0 max-w-[90%] origin-[0_0] truncate text-black/[0.60] transition-all duration-200 ease-out peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:scale-[0.8] peer-data-[te-input-focused]:text-primary motion-reduce:transition-none dark:text-white/[0.60] dark:peer-focus:text-primary data-[te-input-state-active]:scale-[0.8] group-data-[te-validation-state='invalid']:!text-error group-data-[te-validation-state='invalid']:peer-focus:!text-error peer-disabled:opacity-60 peer-disabled:cursor-not-allowed", {
        '!text-error peer-focus:!text-error peer-data-[te-input-focused]:!text-error dark:!text-error dark:peer-focus:!text-error dark:peer-data-[te-input-focused]:!text-error': isFieldValid,
      }),
    selectLabelSizeDefault:
      'pt-3 leading-[1.6] peer-focus:-translate-y-[1.25rem] peer-data-[te-input-state-active]:-translate-y-[1.25rem] data-[te-input-state-active]:-translate-y-[1.25rem]',
    notch:
      clsx("group flex w-full max-w-full h-full text-left select-none pointer-events-none absolute transition-all top-0 after:content[''] after:block after:w-full after:absolute after:bottom-0 left-0 after:border-b-2 after:transition-transform after:duration-300 after:scale-x-0 after:border-primary peer-focus:after:scale-x-100 peer-focus:after:border-primary peer-data-[te-input-focused]:after:scale-x-100 peer-data-[te-input-focused]:after:border-primary group-data-[te-validation-state='invalid']:after:!border-error", {
        'after:!border-error peer-focus:after:!border-error peer-data-[te-input-focused]:after:!border-error': isFieldValid,
      }),
    notchLeading:
      'pointer-events-none border-b border-solid box-border bg-transparent transition-none duration-0 left-0 top-0 h-full w-0 border-r-0 rounded-l-none group-data-[te-input-focused]:border-r-0 group-data-[te-input-state-active]:border-r-0 peer-disabled:group-[]:border-dotted',
    notchLeadingNormal:
      clsx('border-black/[0.24] dark:border-white/[0.24] group-data-[te-input-focused]:shadow-none group-data-[te-input-focused]:border-black/[0.24] dark:group-data-[te-input-focused]:border-white/[0.24]', {
        '!border-error dark:!border-error': isFieldValid,
      }),
    notchMiddle:
      'pointer-events-none border-b border-solid box-border bg-transparent transition-none duration-0 grow-0 shrink-0 basis-auto w-auto max-w-[calc(100%-1rem)] h-full border-r-0 border-l-0 group-data-[te-input-focused]:border-x-0 group-data-[te-input-state-active]:border-x-0 group-data-[te-input-focused]:border-t-0 group-data-[te-input-state-active]:border-t-0 group-data-[te-input-focused]:border-solid group-data-[te-input-state-active]:border-solid group-data-[te-input-focused]:border-t-transparent group-data-[te-input-state-active]:border-t-transparent peer-disabled:group-[]:border-dotted',
    notchMiddleNormal:
      clsx('border-black/[0.24] dark:border-white/[0.24] group-data-[te-input-focused]:shadow-none group-data-[te-input-focused]:border-black/[0.24] dark:group-data-[te-input-focused]:border-white/[0.24]', {
        '!border-error dark:!border-error': isFieldValid,
      }),
    notchTrailing:
      'pointer-events-none border-b border-solid box-border bg-transparent transition-none duration-0 grow h-full border-l-0 rounded-r-none group-data-[te-input-focused]:border-l-0 group-data-[te-input-state-active]:border-l-0 peer-disabled:group-[]:border-dotted',
    notchTrailingNormal:
      clsx('border-black/[0.24] dark:border-white/[0.24] group-data-[te-input-focused]:shadow-none group-data-[te-input-focused]:border-black/[0.24] dark:group-data-[te-input-focused]:border-white/[0.24]', {
        '!border-error dark:!border-error': isFieldValid,
      }),
    selectArrow:
      'block w-9 h-9 p-1.5 m-0 text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out absolute right-0 !top-1/2 -translate-y-1/2 z-0 dark:text-white/[0.60]',
    dropdown:
      'relative outline-none min-w-[100px] m-0 scale-[0.8] opacity-0 bg-white shadow-[0_2px_5px_0_rgba(0,0,0,0.16),_0_2px_10px_0_rgba(0,0,0,0.12)] transition duration-200 motion-reduce:transition-none data-[te-select-open]:scale-100 data-[te-select-open]:opacity-100 dark:bg-charleston-green',
    selectOption:
      'flex flex-row items-center justify-between w-full px-4 truncate text-black/[0.87] bg-transparent select-none cursor-pointer data-[te-input-multiple-active]:bg-black/[0.10] hover:[&:not([data-te-select-option-disabled])]:bg-black/[0.04] hover:data-[te-input-state-active]:!bg-black/[0.10] data-[te-input-state-active]:bg-black/[0.10] data-[te-select-option-selected]:data-[te-input-state-active]:bg-black/[0.10] data-[te-select-selected]:data-[te-select-option-disabled]:cursor-default data-[te-select-selected]:data-[te-select-option-disabled]:text-black/[0.38] data-[te-select-selected]:data-[te-select-option-disabled]:bg-transparent data-[te-select-option-selected]:bg-black/[0.10] data-[te-select-option-disabled]:text-black/[0.38] data-[te-select-option-disabled]:cursor-default group-data-[te-select-option-group-ref]/opt:pl-7 dark:text-white/[0.87] dark:hover:[&:not([data-te-select-option-disabled])]:bg-white/[0.04] dark:hover:data-[te-input-state-active]:!bg-white/[0.10] dark:data-[te-input-state-active]:bg-white/[0.10] dark:data-[te-select-option-selected]:data-[te-input-state-active]:bg-white/[0.10] dark:data-[te-select-option-disabled]:text-white/[0.38] dark:data-[te-input-multiple-active]:bg-white/[0.10]',
  });
});

/** Validation Handler */
const validationList = [].slice.call(
  document.querySelectorAll('[data-te-validation-init]')
);

validationList.map((validationItem) => {
  return new Validation(validationItem, {
    submitCallback: (e, isValid) => {
      if (isValid) {
        validationItem.submit();
      }
    },
    customErrorMessages: teCustomErrorMessage,
    customRules: teCustomRules,
    validFeedback: '',
  }, {
    labelValid:
      'text-black/[0.38]',
    labelInvalid:
      'text-error',
    notchLeadingValid:
      '!border-x-0 !border-t-0 !border-b !transition-none !duration-0 w-0 !rounded-l-none !border-black/[0.24] dark:!border-white/[0.24] group-data-[te-input-focused]:!shadow-none group-data-[te-input-focused]:!border-black/[0.24] dark:group-data-[te-input-focused]:!border-white/[0.24]',
    notchLeadingInvalid:
      '!border-x-0 !border-t-0 !border-b !transition-none !duration-0 w-0 !rounded-l-none !border-error dark:!border-error group-data-[te-input-focused]:!shadow-none group-data-[te-input-focused]:!border-error dark:group-data-[te-input-focused]:border-error',
    notchMiddleValid:
      '!border-x-0 !border-t-0 !border-b !transition-none !duration-0 group-data-[te-input-focused]:!border-t-0 group-data-[te-input-state-active]:!border-t-0 !border-black/[0.24] dark:!border-white/[0.24] group-data-[te-input-focused]:!shadow-none group-data-[te-input-focused]:!border-black/[0.24] dark:group-data-[te-input-focused]:!border-white/[0.24]',
    notchMiddleInvalid:
      '!border-x-0 !border-t-0 !border-b !transition-none !duration-0 group-data-[te-input-focused]:!border-t-0 group-data-[te-input-state-active]:!border-t-0 !border-error dark:!border-error group-data-[te-input-focused]:!shadow-none group-data-[te-input-focused]:!border-error dark:group-data-[te-input-focused]:!border-error',
    notchTrailingValid:
      '!border-x-0 !border-t-0 !border-b !transition-none !duration-0 !rounded-r-none !border-black/[0.24] dark:!border-white/[0.24] group-data-[te-input-focused]:!shadow-none group-data-[te-input-focused]:!border-black/[0.24] dark:group-data-[te-input-focused]:!border-white/[0.24]',
    notchTrailingInvalid:
      '!border-x-0 !border-t-0 !border-b !transition-none !duration-0 !rounded-r-none !border-error dark:!border-error group-data-[te-input-focused]:!shadow-none group-data-[te-input-focused]:!border-error dark:group-data-[te-input-focused]:!border-error',
    checkboxValid:
      'checked:!border-primary checked:!bg-primary checked:focus:before:!shadow-[0px_0px_0px_13px_theme(colors.primary)] dark:checked:!border-primary dark:checked:!bg-primary dark:checked:focus:before:!shadow-[0px_0px_0px_13px_theme(colors.primary)]',
    checkboxInvalid:
      'checked:!border-error checked:!bg-error checked:focus:before:!shadow-[0px_0px_0px_13px_theme(colors.error)] dark:checked:!border-error dark:checked:!bg-error dark:checked:focus:before:!shadow-[0px_0px_0px_13px_theme(colors.error)]',
    radioValid:
      'checked:!border-primary checked:after:!border-primary checked:after:!bg-primary checked:focus:!border-primary checked:focus:before:!shadow-[0px_0px_0px_13px_theme(colors.primary)] dark:checked:!border-primary dark:checked:focus:before:!shadow-[0px_0px_0px_13px_theme(colors.primary)',
    radioInvalid:
      'checked:!border-error checked:after:!border-error checked:after:!bg-error checked:focus:!border-error checked:focus:before:!shadow-[0px_0px_0px_13px_theme(colors.error)] dark:checked:!border-error dark:checked:focus:before:!shadow-[0px_0px_0px_13px_theme(colors.error)',
    validFeedback:
      'hidden absolute top-full left-0 mb-2 w-full text-xs tracking-normal text-transparent break-words',
    invalidFeedback:
      'block absolute top-full left-0 mb-2 w-full text-xs tracking-normal text-error break-words',
    elementValidated:
      'mb-6',
  });
});

initTE({
  Validation,
  Select,
  Datepicker,
  Input,
  Offcanvas,
  Collapse,
  Dropdown,
  PerfectScrollbar,
  Tooltip,
  Toast,
});
