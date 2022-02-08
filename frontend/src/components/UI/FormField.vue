<template lang="pug">
.input
  .input-element(
    :class="classes"
    data-custom-interaction)

    component(
      ref="formElement"
      :is="tag"
      :name="field.name"
      :placeholder="field.placeholder"
      :value="modelValue"
      :disabled="disabled"
      @blur="$emit('onBlur')"
      @input="onInput")

  transition(name="error")
    .input-error(v-if="error") {{ error }}

</template>

<script>
import IMask from 'imask';

export default {
  name: 'FormField',
  props: {
    modelValue: [String, Number],
    field: {
      type: Object,
      required: true
    }
  },
  computed: {
    tag() {
      return this.field.tag || 'input';
    },
    classes() {
      return {
        active: !!this.modelValue,
        error: !!this.field.errors && this.field.touched,
        success: !this.field.errors && this.field.validator
      }
    },
    hasMask() {
      return this.field.validator === 'phone';
    },
    error() {
      return this.field.errors && this.field.touched ? this.field.errors[0] : false;
    },
    disabled() {
      return this.field.disabled;
    }
  },
  mounted() {
    if (this.hasMask) this.createMask();
  },
  unmounted() {
    if (this.hasMask) this.destroyMask();
  },
  methods: {
    createMask() {
      this.mask = IMask(this.$refs.formElement, {
        mask: '+{7} (000) 000-00-00',
        lazy: true
      });

      this.mask.on("accept", () => {
        this.$emit('update:modelValue', this.mask.value);
      });

      this.stopWatchModel = this.$watch(() => this.modelValue, () => {
        this.mask.updateValue();
        this.mask.updateControl();
        this.$emit('update:modelValue', this.mask.value);
      }, { 
        flush: 'post'
      })
    },
    destroyMask() {
      this.mask.destroy();
      this.stopWatchModel();
    },
    onInput(event) {
      if (!this.hasMask) {
        this.$emit('update:modelValue', event.target.value);
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.error-enter-active, .error-leave-active {
  transition: opacity var(--animation-duration-1) ease-in-out;
}
.error-enter-from, .error-leave-to {
  opacity: 0;
}

.input {
  --height: 54px;
  --border: 2px;
  --border-color: var(--color-borders);
  --color: var(--color-accent-1);
  --color-placeholder: var(--color-muted-2);
  --px: 12px;
  --py: calc((var(--height) - 1em * var(--base-line-height)) / 2);
  --pt: calc(var(--py) + var(--border) / 2);
  --pb: calc(var(--py) - var(--border) / 2);
  position: relative;

  .input-element {
    position: relative;
    border-bottom: var(--border) solid var(--border-color);
    transition: border-color var(--trs-1);

    input, textarea {
      width: 100%;
      padding: var(--pt) var(--px) var(--pb) var(--px);
      font-size: 18px;
      color: var(--color);
      
      &:-webkit-autofill {
        -webkit-text-fill-color: var(--color);
      }
      &::placeholder {
        transition: opacity var(--trs-1), color var(--trs-1);
        color: var(--color-placeholder);
      }
      &:focus {
        &::placeholder {
          opacity: 0;
        }
      }
    }

    textarea {
      min-height: var(--height);
    }

    input {
      overflow: hidden;
      text-overflow: ellipsis;
    }

    &[data-hover] {
      --border-color: var(--color-accent-1);
    }

    &.active {
      --border-color: var(--color-accent-2);
    }

    &.error {
      --border-color: var(--color-error);
    }

    &.success {
      --border-color: var(--color-success);
    }
  }

  .input-error {
    color: var(--color-error);
    font-size: 12px;
    padding: 6px var(--px) 0 var(--px);
  }
}
</style>