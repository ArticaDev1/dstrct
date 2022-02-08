<template lang="pug">
section.section.form-section
  BackgroundFigure.form-section__figure(
    v-if="figure"
    :name="'14'")
  .container
    SmallSectionTitle Обратная связь
    .form-section__head.row
      .col-md-10.offset-md-1.col-xl-12.offset-xl-0
        h2 Хотите реализовать свой проект с нами?
        p.color-muted-1 Заполните форму и получите бесплатную консультацию специалиста

    form(@submit.prevent="submit").form-section__form 

      FormField.form-section__field(
        v-model="fields[0].value"
        :field="fields[0]"
        @onBlur="fields[0].touched = true")

      FormField.form-section__field(
        v-model="fields[1].value"
        :field="fields[1]"
        @onBlur="fields[1].touched = true")

      ButtonElement.form-section__submit(
        :tag="'button'"
        :modifier="'2'"
        :disabled="!valid || loading"
        :loader="loading"
        type="submit")
        | Отправить заявку
        
      .form-section__privacy-text.color-muted-2(v-if="agreement") Нажимая кнопку «Отправить заявку» вы соглашаетесь с условиями 
        a(:href="agreement" target="_blank") Политики&nbsp;конфеденциальности

  Teleport(to="#app")
    ModalSuccess(
      :visible="modalSuccessVisible"
      @close="modalSuccessVisible = false")

</template>

<script>
import { useFormFeedback } from "@/use/formFeedback";
import { useStore } from 'vuex';
import { computed, watch, ref } from 'vue';

import ModalSuccess from "@/components/ModalSuccess";

export default {
  components: {
    ModalSuccess
  },
  props: {
    figure: {
      type: Boolean,
      default: true
    }
  },
  setup() {
    const { fields, valid, submitted, loading, submit } = useFormFeedback();

    const store = useStore();
    const agreement = computed(() => store.state.route.data.agreement);
    const modalSuccessVisible = ref(false);

    watch(submitted, (value) => {
      if (value) {
        modalSuccessVisible.value = true;
        submitted.value = false;
      }
    })

    return { fields, valid, submitted, loading, submit, agreement, modalSuccessVisible };
  }
}
</script>

<style lang="scss" scoped>
.form-section {
  &__figure {
    width: calc(var(--page-width) * 0.78);
    left: calc(var(--page-width) * 0.05);
    bottom: calc(var(--page-width) * 0.05);
  }
  &__head {
    margin-bottom: 120px;
  }
  &__form {
    display: flex;
    align-items: center;
    gap: 0 var(--grid-gutter-width);
  }
  &__field {
    flex: 1 1 auto;
  }
  &__submit {
    flex: 0 0 auto;
    width: 225px;
  }
  &__privacy-text {
    flex: 0 0 auto;
    width: 240px;
    font-size: 12px;
  }
  @include media-breakpoint-up(xl) {
    &__field {
      :deep(.input-error) {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
      }
    }
  }
  @include media-breakpoint-down(xxl) {
    &__head {
      margin-bottom: 100px;
    }
  }
  @include media-breakpoint-down(xl) {
    &__head {
      text-align: center;
      margin-bottom: 70px;
    }
    &__form {
      flex-direction: column;
    }
    &__field {
      width: 460px;
      &:nth-child(1) {
        margin-bottom: 28px;
      }
      &:nth-child(2) {
        margin-bottom: 80px;
      }
    }
    &__submit {
      margin-bottom: 26px;
    }
    &__privacy-text {
      max-width: 300px;
      width: auto;
      text-align: center;
    }
  }
  @include media-breakpoint-down(lg) {
    &__figure {
      width: calc(var(--page-width) * 0.9);
      bottom: calc(var(--page-width) * 0.1);
    }
    &__head {
      text-align: left;
      margin-bottom: 50px;
    }
  }
  @include media-breakpoint-down(md) {
    &__field {
      width: 100%;
    }
  }
  @include media-breakpoint-down(sm) {
    &__figure {
      width: calc(var(--page-width) * 2);
      left: calc(var(--page-width) * -0.5);
      bottom: 45%;
    }
  }
}
</style>