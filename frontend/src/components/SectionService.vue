<template lang="pug">
  
section.section.section-services.color-accent-1
  .container
    SmallSectionTitle Services

  .section-services__content

    .service-item(data-custom-interaction)
      SectionServiceDropdownElement(
        :element="completedElements[0]")
        template(v-slot:content)
          .row
            .col-xl-7
              p(v-if="services[0].about") {{ services[0].about }}
              p.d-flex(v-if="services[0].price")
                span.color-muted-1 Стоимость:&nbsp;&nbsp;&nbsp;
                | {{ services[0].price }}

    .service-item(data-custom-interaction)
      SectionServiceDropdownElement(
        :element="completedElements[1]")
        template(v-slot:content)
          .row.mb-30.mb-md-40.mb-xl-25(v-if="services[1].about")
            .col-xl-7
              p {{ services[1].about }}
          
          .mb-55.mb-md-40
            p Этапы создания дизайн-проекта:

          .items.row
            .items__element.col-md-4.col-xl-2
              span.items__element-index 1
              p.items__element-text Выезд и контрольные замеры объекта
            .items__element.col-md-4.col-xl-2
              span.items__element-index 2
              p.items__element-text Составление технического задания на проектирование
            .items__element.col-md-4.col-xl-2
              span.items__element-index 3
              p.items__element-text Создание 2-3 вариантов планировочного решения с расстановкой мебели
            .items__element.col-md-4.col-xl-2
              span.items__element-index 4
              p.items__element-text 3D визуализация (2 правки) (3-4 ракурса для каждого помещения)
            .items__element.col-md-4.col-xl-2
              span.items__element-index 5
              p.items__element-text Разработка рабочих чертежей (количество и состав определяется для каждого проекта индивидуально)
            .items__element.col-md-4.col-xl-2
              span.items__element-index 6
              p.items__element-text Реализация
          
          .row.mt-55.mt-md-40(v-if="services[1].price")
            p.col-sm-6.d-flex
              span.color-muted-1 Стоимость:&nbsp;&nbsp;&nbsp;
              span {{ services[1].price }}
            p.color-muted-3.col-sm-6(v-if="services[1].signature") ({{ services[1].signature }})

    .service-item(data-custom-interaction)
      SectionServiceLinkElement(
        :element="completedElements[2]")

    .service-item(data-custom-interaction)
      SectionServiceLinkElement(
        :element="completedElements[3]")

    .service-item(data-custom-interaction)
      SectionServiceDropdownElement(
        :element="completedElements[4]")
        template(v-slot:content)
          .row
            .col-xl-7 
              p(v-if="services[4].about") {{ services[4].about }}
              p.d-flex.flex-wrap(v-if="services[4].price")
                span.color-muted-1 Стоимость работы бригад:&nbsp;&nbsp;&nbsp;
                | {{ services[4].price }}
        

</template>

<script>
import { mapState } from 'vuex';
import SectionServiceDropdownElement from "@/components/SectionServiceDropdownElement";
import SectionServiceLinkElement from "@/components/SectionServiceLinkElement";

export default {
  components: {
    SectionServiceLinkElement,
    SectionServiceDropdownElement
  },
  data() {
    return {
      elements: [
        {
          type: 'dropdown',
          id: '#help-in-choosing-an-apartment',
        }, {
          type: 'dropdown',
          id: '#design-project'
        }, {
          routeName: 'equipment'
        }, {
          routeName: 'monitoring'
        }, {
          type: 'dropdown',
          id: '#help-in-choosing-builders'
        }
      ]
    }
  },
  computed: {
    hash() {
      return this.$route.hash;
    },
    ...mapState({
      services: state => state.route.data.services
    }),
    completedElements() {
      return this.elements.map((element, index) => {
        const name = this.services[index].name;
        if (name) element.title = name;
        return element;
      })
    }
  },
  watch: {
    hash(value) {
      this.toggleDropdown(value);
    }
  },
  created() {
    this.toggleDropdown(this.hash);
  },
  methods: {
    toggleDropdown(id) {
      for (let element of this.elements) {
        if (element.type === 'dropdown') {
          element.state = element.id === id;
        }
      }
    }
  }
}
</script>

<style lang="scss" scoped>
  .items {
    gap: 40px 0;
    &__element {
      position: relative;
      &::after {
        content: '';
        display: block;
        background-color: var(--color-borders);
      }
    }
    &__element-index {
      display: block;
      border-radius: 50%;
      text-align: center;
      line-height: 29px;
      width: 31px;
      border: 1px solid var(--color-muted-2);
      color: var(--color-accent-1);
      font-size: 16px;
    }
    @include media-breakpoint-up(md) {
      &__element-text {
        text-align: center;
      }
      &__element-index {
        margin-bottom: 30px;
      }
    }
    @include media-breakpoint-up(xl) {
      &__element {
        &:not(:last-child) {
          &::after {
            height: 1px;
            width: calc(100% - 30px);
            position: absolute;
            left: calc(81px + var(--grid-gutter-width) / 2);
            top: 15px;
          }
        }
      }
      &__element-text {
        font-size: 12px;
      }
      &__element-index {
        margin-left: 50px;
      }
    }
    @include media-breakpoint-between(md, xl) {
      &__element-index {
        margin-left: auto;
        margin-right: auto;
      }
      &__element {
        &::after {
          height: 1px;
          position: absolute;
          top: 15px;
        }
        &:nth-child(1), &:nth-child(2), &:nth-child(5), &:nth-child(6) {
          &::after {
            width: calc(100% - 30px);
          }
        }
        &:nth-child(3), &:nth-child(4) {
          &::after {
            width: 1000px;
          }
        }
        &:nth-child(1), &:nth-child(2), &:nth-child(3) {
          &::after {
            left: calc(50% + 15px);
          }
        }
        &:nth-child(4), &:nth-child(5), &:nth-child(6) {
          &::after {
            right: calc(50% + 15px);
          }
        }
      }
    }
    @include media-breakpoint-down(md) {
      &__element {
        display: flex;
        align-items: flex-start;
        gap: 30px;
        &:not(:last-child) {
          &::after {
            width: 1px;
            position: absolute;
            height: calc(100% + 9px);
            top: 34px;
            left: calc(15px + var(--grid-gutter-width) / 2);
          }
        }
      }
      &__element-index {
        flex: 0 0 auto;
        margin-top: 3px;
      }
      &__element-text {
        min-height: 100%;
        display: flex;
        align-items: center;
      }
    }
  }

  .service-item {
    cursor: pointer;
    transition: background-color var(--trs-1);
    &:not(:last-child) {
      border-bottom: 1px solid var(--color-muted-3);
    }
    &[data-touch], &[data-hover] {
      background-color: rgba(255, 255, 255, 0.05);
    }
  }

  @include media-breakpoint-down(xl) {
    &__content-container {
      padding-bottom: 45px;
    }
  }
</style>