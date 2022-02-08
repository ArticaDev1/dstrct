<template lang="pug">
BackgroundFigure.top-figure(:name="'12'")

HeadingTitle(:text="['Комплектация']")

section.section
  .container
    SmallSectionTitle About
    .row
      .col-xl-10.offset-xl-1
        .color-base(
          :class="{'h5': $window.innerWidth >= $breakpoints.xl}")
          p Комплектация – это один из этапов, направленных на точную реализацию вашего проекта. На сегодняшний день рынок  переполнен множеством различных фабрик и материалов. Самостоятельная реализация даже самого подробного проекта полна неожиданностей и сложностей выбора того или иного поставщика.
          p Мы потоянно повторяем нашим заказчикам, что каждый проект уникален не только стилем или цветовым решением. 
          p В первую очередь уникальность заключается в сложности и последовательности его реализации. От этих этапов зависит своевременная поставка материалов на объект.

section.section
  .container
    SmallSectionTitle Смета
    .row
      .col-xl-10.offset-xl-1
        .mb-20.mb-xl-30.color-base(
          :class="{'h5': $window.innerWidth >= $breakpoints.xl}")
          p Основной документ который поможет вам увидеть и сформировать представление о затратах на различных этапах ремонта - это смета.
          p В смете будут прописаны все позиции в соответсвии с вашим проектом, включая сложные столярные изделия по индивидуальному заказу.
          p Это позволяет оценить реальную стомость реализации проекта.
        p.color-accent-1
          span.color-muted-1 Стоимость:&nbsp;&nbsp;&nbsp;
          | {{ price }}

    .row.mt-50.mt-xl-80.estimate-items
      .col-6.col-md-4.col-xl-2.estimate-items__element
        img(src="@/assets/img/icons/smeta/1.svg" alt="icon").estimate-items__element-icon
        h5.estimate-items__element-title отделочные материалы
      .col-6.col-md-4.col-xl-2.estimate-items__element
        img(src="@/assets/img/icons/smeta/2.svg" alt="icon").estimate-items__element-icon
        h5.estimate-items__element-title освещение
      .col-6.col-md-4.col-xl-2.estimate-items__element
        img(src="@/assets/img/icons/smeta/3.svg" alt="icon").estimate-items__element-icon
        h5.estimate-items__element-title сантехника
      .col-6.col-md-4.col-xl-2.estimate-items__element
        img(src="@/assets/img/icons/smeta/4.svg" alt="icon").estimate-items__element-icon
        h5.estimate-items__element-title техника
      .col-6.col-md-4.col-xl-2.estimate-items__element
        img(src="@/assets/img/icons/smeta/5.svg" alt="icon").estimate-items__element-icon
        h5.estimate-items__element-title мебель
      .col-6.col-md-4.col-xl-2.estimate-items__element
        img(src="@/assets/img/icons/smeta/6.svg" alt="icon").estimate-items__element-icon
        h5.estimate-items__element-title декор

section.section
  .container
    SmallSectionTitle В ходе комплектации мы:
    .d-grid.grid-columns-xl-2.column-gap-grid.row-gap-30.row-gap-xl-grid.grid-rows-xl-same
      ContentBox(:index="'1'")
        h3 Находим образцы материалов и делаем выкрасы
        p Это необходимо для того что бы вы вживую увидели и выбрали цвет инженерной доски или паркета, цвет стен, текстиль, фактуры и цвета для мебели и т.д.
      ContentBox(:index="'2'")
        h3 Привозим образцы на объект для согласования
        p Вы сможете увидеть все образцы при реальном освещении, которое будет у вас дома. Зачастую выбор определенных цветов удаленно или в помещении с другим освещением может плохо отразится на финальном результате и вашем настроении :)
      ContentBox(:index="'3'")
        h3 Составляем смету с выбранными позициями, утверждаем цены и делаем закупку
        p Закупка всех позиций происходит поэтапно. Перед покупкой вам будет направлен счет и договор. Наличие и поставку мы отслеживаем самостоятельно  для своевремнной поставки на объект.
      ContentBox(:index="'4'")
        h3 Уведомляем о поступлении позиций
        p Вы всегда в курсе о том на какой стадии ваш заказ.

section.section.selection
  BackgroundFigure.selection__figure(:name="'13'")
  .container
    SmallSectionTitle Подбор
    .row
      .col-xl-10.offset-xl-1
        h5.mb-45.mb-xl-80.color-base Предоставляем на выбор фирмы разных ценовых категорий, из которых вы можете выбрать подходящую вам по стоимости позицию
        picture
          source(:data-srcset="require('@/assets/img/podbor/small.png')" media='--small')
          source(:data-srcset="require('@/assets/img/podbor/medium.png')" media='--medium')
          source(:data-srcset="require('@/assets/img/podbor/large.png')" media='--large')
          img(:data-src="require('@/assets/img/podbor/large.png')" alt='image').lazyload.lazypreload

section.section
  .container
    SmallSectionTitle Преимущества
    .row.mt-80.mt-md-130.mt-xl-80.row-gap-80.row-gap-md-130.row-gap-xl-70
      .col-sm-10.offset-sm-1.col-md-6.offset-md-3.col-xl-4.offset-xl-0.text-center
        h3 Преимущества
        p Нет необходимости тратить время на походы по магазинам и поиск добросовестных поставщиков. 
      .col-sm-10.offset-sm-1.col-md-6.offset-md-3.col-xl-4.offset-xl-0.text-center 
        h3 Скидки
        p Все наши партнеры предоставляют дополнительные скидки, которые мы с радостью отдадим вам
      .col-sm-10.offset-sm-1.col-md-6.offset-md-3.col-xl-4.offset-xl-0.text-center
        h3 Своевременная поставка
          br(v-if="$window.innerWidth >= $breakpoints.xl")
          | на объект
        p Очень важно что бы все позиции поступили на объект вовремя, что бы избежать простоя строителей

section.section.gallery(v-if="images")
  .container
    SmallSectionTitle Gallery
    GallerySlider(:images="images")

FormSection
SectionContacts

</template>

<script>
import { mapState } from 'vuex';
import ViewAnimationEvents from "@/mixins/ViewAnimationEvents";

import HeadingTitle from '@/components/HeadingTitle';
import SectionContacts from "@/components/SectionContacts";
import ContentBox from "@/components/ContentBox";
import GallerySlider from "@/components/GallerySlider";
import FormSection from "@/components/FormSection";

export default {
  mixins: [ViewAnimationEvents],
  components: {
    HeadingTitle,
    SectionContacts,
    ContentBox,
    GallerySlider,
    FormSection
  },
  computed: {
    ...mapState({
      price: state => state.route.data.price,
      images: state => state.route.data.images
    })
  }
}
</script>

<style lang="scss" scoped>
.top-figure {
  width: 73%;
  top: 0;
  right: 0;
  @include media-breakpoint-down(xl) {
    width: 100%;
  }
  @include media-breakpoint-down(sm) {
    width: 150%;
  }
}

.selection {
  &__figure {
    width: 50%;
    left: 0;
    top: -5%;
  }
  @include media-breakpoint-down(xl) {
    &__figure {
      width: 75%;
      top: 0;
      transform: translateY(-60%);
    }
  }
  @include media-breakpoint-down(sm) {
    &__figure {
      width: 130%;
      transform: translateY(-70%);
    }
  }
}
 
.estimate-items {
  row-gap: 45px;
  &__element {
    &-icon {
      height: 70px;
      margin: 0 auto;
    }
    &-title {
      text-align: center;
      margin-top: 30px;
      color: var(--color-base);
    }
  }
  @include media-breakpoint-down(xl) {
    &__element {
      &-icon {
        height: 50px;
      }
    }
  }
  @include media-breakpoint-down(sm) {
    row-gap: 50px;
    &__element {
      &-title {
        margin-top: 20px;
      }
    }
  }
}

</style>