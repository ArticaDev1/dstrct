<template lang="pug">

.service-element-head 
  .container
    .row.align-items-center.service-element-head__row
      .col-auto.col-xl-2.order-sm-2
        SpriteIcon.icon_plus(v-if="icon=='plus'" :id="icon")
        SpriteIcon.icon_link(v-if="icon=='link'" :id="icon")
      h2.mb-0.mt-0.col.col-xl-10 {{title}}

</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    },
    icon: {
      type: String,
      required: true
    }
  },
}
</script>

<style lang="scss" scoped>
  .service-element-head {
    width: 100%;
    padding: 34px 0;
    .icon {
      color: var(--color-accent-1);
      width: 36px;
      height: var(--icon-size);
      transform: var(--transform);
      transition: transform var(--trs-1);
      will-change: transform;
      &_plus {
        --icon-size: 36px;
      }
      &_link {
        --icon-size: 30px;
      }
    }
    @include media-breakpoint-down(lg) {
      .icon {
        &_plus {
          --icon-size: 24px;
        }
        &_link {
          --icon-size: 20px;
        }
      }
    }
    @include media-breakpoint-down(sm) {
      &__row {
        --bs-gutter-x: var(--container-padding-x);
      }
      .icon {
        width: var(--icon-size);
      }
    }
  }
</style>