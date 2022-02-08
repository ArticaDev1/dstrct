<template lang="pug">
Modal(
  :closeIcon="true"
  :visible="visible"
  @close="$emit('close')")
  .modal-form
    .modal-form__content
      .modal-form__head
        h2 Хотите реализовать свой проект с&nbsp;нами?
        p.color-muted-1 Заполните форму и получите бесплатную консультацию специалиста

      form(@submit.prevent="submit").modal-form__form 

        FormField.modal-form__field(
          v-model="fields[0].value"
          :field="fields[0]"
          @onBlur="fields[0].touched = true")

        FormField.modal-form__field(
          v-model="fields[1].value"
          :field="fields[1]"
          @onBlur="fields[1].touched = true")

        ButtonElement.modal-form__submit(
          :tag="'button'"
          :modifier="'2'"
          :disabled="!valid || loading"
          :loader="loading"
          type="submit")
          | Отправить заявку
          
        .modal-form__privacy-text.color-muted-2(v-if="agreement") Нажимая кнопку «Отправить заявку» вы соглашаетесь с условиями 
          a(:href="agreement" target="_blank") Политики&nbsp;конфеденциальности

</template>

<script>
import { useFormFeedback } from "@/use/formFeedback";
import { useStore } from 'vuex';
import { computed, watch } from 'vue';

import Modal from "@/components/Modal";

export default {
  components: {
    Modal
  },
  props: {
    visible: {
      type: Boolean,
      default: false
    }
  },
  emits: ['close', 'submitted'],
  setup(props, { attrs, slots, emit, expose }) {
    const { fields, valid, submitted, loading, submit, reset } = useFormFeedback();

    const store = useStore();
    const agreement = computed(() => store.state.route.data.agreement);

    watch(submitted, (value) => {
      if (value) {
        emit('submitted');
        submitted.value = false;
      }
    })

    watch(
      () => props.visible, (value) => {
      if (!value && !loading.value) reset();
    })

    return { fields, valid, submitted, loading, submit, agreement };
  }
}
</script>

<style lang="scss" scoped>
.modal-form {
  width: 1120px;
  padding: 60px 80px 90px 80px;
  &__content {
    position: relative;
    z-index: 2;
  }
  &__head {
    text-align: center;
    margin-bottom: 70px;
  }
  &__form {
    max-width: 460px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  &__field {
    width: 100%;
    &:nth-child(1) {
      margin-bottom: 28px;
    }
    &:nth-child(2) {
      margin-bottom: 80px;
    }
  }
  &__submit {
    margin-bottom: 34px;
    width: 225px;
  }
  &__privacy-text {
    max-width: 400px;
    text-align: center;
    font-size: 12px;
  }
  @include media-breakpoint-down(xxl) {
    width: 1000px;
  }
  @include media-breakpoint-down(xl) {
    width: 100%;
    &__privacy-text {
      max-width: 300px;
    }
  }
  @include media-breakpoint-down(lg) {
    padding: 60px 60px 90px 60px;
    &__head {
      margin-bottom: 50px;
    }
  }
  @include media-breakpoint-down(sm) {
    padding: 50px 16px 60px 16px;
  }
}
</style>