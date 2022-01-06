<template lang="pug">
  
section.section.section-services
  .container
    SmallSectionTitle Services

  .section-services__content

    .service-item(
      v-for="element of elements" 
      :key="element.id"
      data-custom-interaction)
      
      SectionServiceLinkElement(v-if="element.type=='link'" :element="element")
      
      SectionServiceDropdownElement(v-else-if="element.type=='dropdown'" :element="element" @toggle="toggleDropdown")
        template(v-if='element.id==1' v-slot:content)
          .row
            .col-xl-7
              p Помощь в выборе квартиры на этапе ее покупки поможет вам избавится от неожиданностей при создании дизайн-проекта и сэкономить на работах. Приобретая квартиру необходимо провести ее функциональный анализ что бы в дальнейшем максимально использовать всю площадь.
              p 
                span.color-muted-2 Стоимость: 
                | Бесплатно при заключении договора на дизайн-проект.
        template(v-else-if='element.id==2' v-slot:content)
          .row.mb-40
            .col-xl-7
              p Проект включает в себя 3D визуализацию вашей будущей квартиры и все необходимые чертежи для реализации проекта строительной бригадой.
              p Этапы создания дизайн-проекта:   
          .row.mb-40
            .section-services__step.col-xl-2
              span.section-services__step-index 1
              span.section-services__step-text.color-muted-1 Выезд и контрольные замеры объекта
            .section-services__step.col-xl-2
              span.section-services__step-index 2
              span.section-services__step-text.color-muted-1 Составление технического задания на проектирование
            .section-services__step.col-xl-2
              span.section-services__step-index 3
              span.section-services__step-text.color-muted-1 Создание 2-3 вариантов планировочного решения с расстановкой мебели
            .section-services__step.col-xl-2
              span.section-services__step-index 4
              span.section-services__step-text.color-muted-1 3D визуализация (2 правки) (3-4 ракурса для каждого помещения)
            .section-services__step.col-xl-2
              span.section-services__step-index 5
              span.section-services__step-text.color-muted-1 Разработка рабочих чертежей (количество и состав определяется для каждого проекта индивидуально)
            .section-services__step.col-xl-2
              span.section-services__step-index 6
              span.section-services__step-text.color-muted-1 Реализация
          .row
            p.col-xl-6.mb-xl-0
              span.color-muted-2 Стоимость: 
              span от 2 000 ₽/м2.
            p.col-xl-6.color-muted-4 (Стоимость выезда для других городов рассчитывается индивидуально).

        template(v-if='element.id==5' v-slot:content)
          .row
            .col-xl-7 
              p Мы можем предложить вам проверенные строительные бригады для реализации вашего проекта. Договор на проведение строительных работ заключается напрямую с бригадой.
              p 
                span.color-muted-2 Стоимость работы бригад: 
                | от 17 000 ₽/м2.
        

</template>

<script>
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
          id: 1,
          title: 'Помощь в выборе квартиры',
          type: 'dropdown'
        }, {
          id: 2,
          title: 'Эскизный дизайн-проект',
          type: 'dropdown'
        }, {
          id: 3,
          title: 'Эскизный дизайн-проект',
          type: 'link',
          routeName: 'typography'
        }, {
          id: 4,
          title: 'Авторский контроль',
          type: 'link',
          routeName: 'typography'
        }, {
          id: 5,
          title: 'Помощь в выборе строительной бригады',
          type: 'dropdown'
        }
      ]
    }
  },
  methods: {

    toggleDropdown(id) {
      for (let index in this.elements) {
        let element = this.elements[index];
        if (element.type == 'dropdown') {
          if (element.id == id) {
            element.state = !element.state;
          } else if (element.id !== id && element.state) {
            element.state = false;
          }
        }
      }
    }

  }
}
</script>

<style lang="scss">
  .section-services {
    &__step {
      position: relative;
      &:not(:last-child) {
        &::after {
          content: '';
          display: block;
          height: 1px;
          background-color: var(--color-muted-3);
          width: calc(100% - 30px);
          position: absolute;
          left: calc(80px + var(--grid-gutter-width) / 2);
          top: 15px;
        }
      }
      &-index {
        display: block;
        border-radius: 50%;
        text-align: center;
        line-height: 29px;
        width: 31px;
        border: 1px solid var(--color-muted-3);
        font-size: 16px;
        margin-bottom: 30px;
        margin-left: 50px;
      }
      &-text {
        display: block;
        font-size: 12px;
        text-align: center;
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
</style>