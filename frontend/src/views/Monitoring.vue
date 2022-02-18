<template lang="pug">
BackgroundFigure.top-figure(v-if="$window.innerWidth >= $breakpoints.xl" :name="'10'")
BackgroundFigure.top-figure(v-else :name="'18'")

HeadingTitle(:text="['Авторский ', 'контроль']")

section.section
  .container
    SmallSectionTitle Об услуге
    .row
      .col-xl-10.offset-xl-1
        .mb-20.mb-xl-30.color-base(
          :class="{'h5': $window.innerWidth >= $breakpoints.xl}")
          p Как только начинается ремонт, даже по проекту, у прораба возникает множество вопросов. А кто лучше автора знает проект? Кто сможет ответить на все вопросы и показать как должно быть? Чтобы все было реализовано в соответствии с проектом, необходим постоянный контроль за всеми работами, что бы избежать многочисленных возможных ошибок. Контроль  позволяет нам оперативно решать все возникающие в ходе работы вопросы, как дистанционно, так и на выезде.
          p В ходе авторского контроля дизайнер следит за визуальной составляющей проекта, утверждает все образцы, вносит изменения в чертежи, следит за точным воплощением проекта в жизнь.
        p.color-accent-1
          span.color-muted-1 Стоимость:&nbsp;&nbsp;&nbsp;
          | {{ price }}

section.section
  .container
    SmallSectionTitle Контролировать объекты можно:
    .d-grid.grid-columns-xl-2.column-gap-grid.row-gap-30.row-gap-xl-grid.grid-rows-xl-same
      ContentBox(:index="'1'" :icon="'eye'")
        h3 Выезжая на объект
        p Выезжая на объект, дизайнер контролирует все работы и отвечает на вопросы возникающие в ходе ремонта.
      ContentBox(:index="'2'" :icon="'monitor'")
        h3 Дистанционный контроль
        p Отлично подходит для удаленных объектов, но так же актуален и на ближайших. Много вопросов возникающих в процессе ремонта можно закрыть по телефону, если это возможно – мы всегда на связи.

section.section
  .container
    SmallSectionTitle Преимущества
    .row.mt-80.mt-md-130.mt-xl-80.row-gap-80.row-gap-md-130.row-gap-xl-70
      .col-sm-10.offset-sm-1.col-md-6.offset-md-3.col-xl-4.offset-xl-0.text-center
        h3 Контроль точности реализации проекта
      .col-sm-10.offset-sm-1.col-md-6.offset-md-3.col-xl-4.offset-xl-0.text-center 
        h3 Экономия 
          br(v-if="$window.innerWidth >= $breakpoints.xl")
          | вашего времени
      .col-sm-10.offset-sm-1.col-md-6.offset-md-3.col-xl-4.offset-xl-0.text-center
        h3 Всегда на связи

FormSection
SectionContacts

</template>

<script>
import { mapState } from 'vuex';
import ViewAnimationEvents from "@/mixins/ViewAnimationEvents";

import HeadingTitle from '@/components/HeadingTitle';
import SectionContacts from "@/components/SectionContacts";
import ContentBox from "@/components/ContentBox";
import FormSection from "@/components/FormSection";

export default {
  mixins: [ViewAnimationEvents],
  components: {
    HeadingTitle,
    SectionContacts,
    ContentBox,
    FormSection
  },
  computed: {
    ...mapState({
      price: state => state.route.data.price,
    })
  }
}
</script>

<style lang="scss" scoped>
.top-figure {
  width: 60%;
  top: 0;
  left: 0;
  @include media-breakpoint-down(xl) {
    width: 100%;
  }
  @include media-breakpoint-down(sm) {
    width: 135%;
    transform: translateY(-10%);
  }
}
</style>