<template lang="pug">

.socials(v-if="socials")
  ul.socials__list
    //v-for
    li.socials__item(v-for="social of socials")
      a.socials__link(
        :href="social.value" 
        target="_blank" 
        rel='noopener') {{social.type}}
        SpriteIcon(:id="social.type")

</template>

<script>
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters({
      socials: 'route/getSocials'
    })
  },
  mounted() {
  }
}
</script>

<style lang="scss" scoped>
.socials {
  --color: var(--color-accent-1);
  --color-hover: var(--color-accent-2);
  &__list {
    display: flex;
    gap: 20px;
  }
  &__link {
    display: block;
    font-size: 0;
    color: var(--color);
    .icon {
      width: 24px;
      height: 24px;
    }
    &[data-touch], &[data-hover] {
      color: var(--color-hover);
    }
  }
}
</style>