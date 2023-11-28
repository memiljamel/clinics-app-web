import validator from 'validator';

export const teCustomErrorMessage = {
  isRequired: "The :attribute field is required.",
  isString: "The :attribute field must be a string.",
  isEmail: "The :attribute field must be a valid email address.",
  isMax: "The :attribute field must not be greater than {max} characters.",
  isMin: "The :attribute field must be at least {min} characters.",
  isDigitsBetween: "The :attribute field must be between {min} and {max} digits.",
  isConfirmed: "The :attribute field confirmation does not match.",
  isDate: "The :attribute field must be a valid date.",
  isDateFormat: "The :attribute field must match the format {format}.",
  isBeforeOrEqual: "The :attribute field must be a date before or equal to {date}.",
  isRegex: "The :attribute field format is invalid.",
  isEnum: "The selected :attribute is invalid.",
  isBoolean: "The :attribute field must be true or false.",
  isImage: "The :attribute field must be an image.",
  isMimes: "The :attribute field must be a file of type: {values}.",
}

export const teCustomRules = {
  isNullable: () => {
    return true;
  },
  isRequired: (value, message) => {
    if (!validator.isEmpty(value)) {
      return true;
    }

    return message;
  },
  isChecked: (value) => {
    if (value) {
      return true;
    }

    return "The :attribute field is required.";
  },
  isString: (value, message) => {
    if (validator.isEmpty(value)) {
      return;
    }

    if (typeof value === "string") {
      return true;
    }

    return message;
  },
  isEmail: (value, message) => {
    if (validator.isEmpty(value)) {
      return;
    }

    const test = validator.isEmail(value, {
      allow_display_name: false,
      require_display_name: false,
      allow_utf8_local_part: true,
      require_tld: true,
      allow_ip_domain: false,
      allow_underscores: true,
      domain_specific_validation: false,
      blacklisted_chars: '',
      host_blacklist: [],
    });

    if (test) {
      return true;
    }

    return message;
  },
  isMin: (value, message, min) => {
    if (validator.isEmpty(value)) {
      return;
    }

    const test = validator.isLength(value, {
      min: parseInt(min),
    });

    if (test) {
      return true;
    }

    return message.replace("{min}", min);
  },
  isMax: (value, message, max) => {
    if (validator.isEmpty(value)) {
      return;
    }

    const test = validator.isLength(value, {
      max: parseInt(max),
    });

    if (test) {
      return true;
    }

    return message.replace("{max}", max);
  },
  isDigitsBetween: (value, message, digits) => {
    if (validator.isEmpty(value)) {
      return;
    }

    const [min, max] = digits.split(',').map(Number);
    const test = validator.isLength(value, {
      min: parseInt(min),
      max: parseInt(max),
    });
    const isNumeric = validator.isNumeric(value, {
      no_symbols: true,
    });

    if (test && isNumeric) {
      return true;
    }

    return message.replace("{min}", min).replace("{max}", max);
  },
  isConfirmed: (value, message, target) => {
    if (validator.isEmpty(value)) {
      return;
    }

    const selector = document.querySelector(target.toString());
    const test = validator.equals(value, selector.value);

    if (test) {
      return true;
    }

    return message;
  },
  isDate: (value, message) => {
    if (validator.isEmpty(value)) {
      return;
    }

    const pattern = /^(\d{1,4}([-./])\d{1,2}\2\d{1,4})$/;
    const test = value.match(pattern);

    if (test) {
      return true;
    }

    return message;
  },
  isDateFormat: (value, message, format) => {
    if (validator.isEmpty(value)) {
      return;
    }

    const test = validator.isDate(value, {
      format: format,
      strictMode: true,
      delimiters: ['/', '-'],
    });

    if (test) {
      return true;
    }

    return message.replace("{format}", format);
  },
  isBeforeOrEqual: (value, message, date) => {
    if (validator.isEmpty(value)) {
      return;
    }

    let newDate;

    if (/^(\d+\s+(day|week|month|year)s?\s+ago|today|yesterday)$/i.test(date)) {
      if (/^\d+\s+(day|week|month|year)s?\s+ago$/i.test(date)) {
        const [, count, unit] = date.match(/^(\d+)\s+(day|week|month|year)s?\s+ago$/i);

        newDate = new Date();

        switch (unit.toLowerCase()) {
          case 'day':
            newDate.setDate(newDate.getDate() - parseInt(count));
            break;
          case 'week':
            newDate.setDate(newDate.getDate() - 7 * parseInt(count));
            break;
          case 'month':
            newDate.setMonth(newDate.getMonth() - parseInt(count));
            break;
          case 'year':
            newDate.setFullYear(newDate.getFullYear() - parseInt(count));
            break;
        }

        newDate = newDate.toISOString();
      } else if (date.toLowerCase() === 'today') {
        newDate = new Date().toISOString();
      } else if (date.toLowerCase() === 'yesterday') {
        newDate = new Date();
        newDate.setDate(newDate.getDate() - 1);
        newDate = newDate.toISOString();
      }
    } else {
      newDate = new Date(date).toISOString();
    }

    const test = (validator.isBefore(value, newDate) || validator.equals(value, newDate));

    if (test) {
      return true;
    }

    return message.replace("{date}", date);
  },
  isRegex: (value, message, patternValue) => {
    if (validator.isEmpty(value)) {
      return;
    }

    const pattern = new RegExp(patternValue);
    const test = pattern.test(value);

    if (test) {
      return true;
    }

    return message;
  },
  isEnum: (value, message, allowedValues) => {
    if (validator.isEmpty(value)) {
      return;
    }

    const values = allowedValues.split(',').map(String);
    const test = validator.isIn(value, values);

    if (test) {
      return true;
    }

    return message;
  },
  isBoolean: (value, message) => {
    if (validator.isEmpty(value.toString())) {
      return;
    }

    if (typeof value === "boolean") {
      return true;
    }

    return message;
  },
  isImage: (value, message) => {
    if (validator.isEmpty(value.toString())) {
      return;
    }

    const fileName = value.split('\\').pop();
    const fileExtension = fileName.split('.').pop().toLowerCase();
    const allowedExtensions = [
      'apng',
      'avif',
      'gif',
      'jpg',
      'jpeg',
      'jfif',
      'pjpeg',
      'pjp',
      'png',
      'svg',
      'webp',
      'bmp',
      'ico',
      'cur',
      'tif',
      'tiff',
    ];

    if (allowedExtensions.includes(fileExtension)) {
      return true;
    }

    return message;
  },
  isMimes: (value, message, allowedExtension) => {
    if (validator.isEmpty(value.toString())) {
      return;
    }

    const fileName = value.split('\\').pop();
    const fileExtension = fileName.split('.').pop().toLowerCase();
    const allowedExtensions = allowedExtension.split(',').map(String);

    if (allowedExtensions.includes(fileExtension)) {
      return true;
    }

    return message.replace("{values}", allowedExtension);
  },
}
