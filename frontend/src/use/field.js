import { ref, watch } from 'vue';

const validate = require("validate.js");

const constraints = {
  phone: {
    presence: {
      allowEmpty: false,
      message: '^Введите ваш номер телефона'
    },
    format: {
      pattern: /^\+[0-9]\s\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}$/,
      message: '^Введите корректный номер телефона'
    }
  },
  name: {
    presence: {
      allowEmpty: false,
      message: '^Введите ваше имя'
    }
  }
};

export function useField(field) {
  const obj = {};

  for (const [key, value] of Object.entries(field)) {
    obj[key] = value;
  }

  obj.value = ref(field.value || '');
  obj.touched = ref(false);

  if (field.validator) {
    obj.errors = ref(false);
    watch(obj.value, (value) => {
      obj.errors.value = validate.single(value, constraints[field.validator]);
    }, { immediate: true });
  }

  return obj;
}