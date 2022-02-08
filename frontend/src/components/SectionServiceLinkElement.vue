<template lang="pug">

router-link(:to="{name: element.routeName}").service-link-element
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
    &[data-touch], &[data-hover] {
      --transform: rotate(45deg);
    }
  }
</style>