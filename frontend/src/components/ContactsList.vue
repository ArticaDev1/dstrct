<template lang="pug">
ul.contacts-list
  li.contacts-list__item(v-for="contact in contacts")
    a.contacts-list__link(
      :class="`contacts-list__link_${contact.type}`"
      :href="contact.href") {{contact.value}}
</template>

<script>
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters({
      contacts: 'route/getContacts'
    }),
  }
}
</script>

<style lang="scss" scoped>
.contacts-list {
  margin: 0 !important;
  &__item {
    &:not(:last-child) {
      margin-bottom: 10px;
    }
  }
  &__link {
    text-decoration: none;
    &_phone {
      color: var(--color-accent-1);
      &[data-touch], &[data-hover] {
        color: #fff;
      }
    }
    &_email {
      color: var(--color-muted-2);
      &[data-touch], &[data-hover] {
        color: var(--color-base);
      }
    }
  }
  @include media-breakpoint-down(sm) {
    &__item {
      &:not(:last-child) {
        margin-bottom: 5px;
      }
    }
  }
}
</style>