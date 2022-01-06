<template lang="pug">

section.section.contacts-section
  .container
    SmallSectionTitle Contacts
    .row
      .col-10.ofsset-1.col-xl-12.offset-xl-0
        ul.contacts-section__list
          li.contacts-section__item(v-for="contact in contacts")
            a.contacts-section__link.h2(
              :class="`contacts-section__link_${contact.type}`"
              :href="contact.href") {{contact.value}}

</template>

<script>
export default {
  props: {
    contacts: {
      type: Array,
      required: true
    }
  },
}
</script>

<style lang="scss">
  .contacts-section {
    &__item {
      &:not(:last-child) {
        margin-bottom: 10px;
      }
    }
    &__link {
      text-decoration: none;
      &_phone {
        color: var(--color-base);
        &[data-touch], &[data-hover] {
          color: #fff;
        }
      }
      &_email {
        color: var(--color-muted-3);
        &[data-touch], &[data-hover] {
          color: var(--color-muted-1);
        }
      }
    }
  }
</style>