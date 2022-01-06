<template lang="pug">

router-link.service-link-element(:to="{name: element.routeName}")
  SectionServiceElementHead(:title="element.title" :icon="'link'")

</template>

<script>
import SectionServiceElementHead from "@/components/SectionServiceElementHead";

export default {
  components: {
    SectionServiceElementHead
  },
  props: {
    element: {
      type: Object,
      required: true
    }
  }
}
</script>

<style lang="scss">
  .service-link-element {
    text-decoration: none;
    --icon-size: 30px;
    &[data-touch], &[data-hover] {
      --hover-transform: rotate(45deg);
    }
  }
</style>