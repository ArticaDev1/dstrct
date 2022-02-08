<template lang="pug">

section.section.contacts-section(v-if="contacts")
  .container
    SmallSectionTitle Contacts
    .row
      .col-10.offset-1.col-xl-12.offset-xl-0
        ContactsList.h2

</template>

<script>
import { mapGetters } from "vuex";
import ContactsList from "@/components/ContactsList";

export default {
  components: {
    ContactsList
  },
  computed: {
    ...mapGetters({
      contacts: 'route/getContacts'
    })
  }
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