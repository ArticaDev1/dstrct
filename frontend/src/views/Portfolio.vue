<template lang="pug">

section.section.portfolio
  .container
    SmallSectionTitle All projects

  ProjectItem.portfolio__item(v-for="(project, index) in projects" :index="index" :projects="projects")

FormSection(:figure="false")
SectionContacts

</template>

<script>
import ViewAnimationEvents from "@/mixins/ViewAnimationEvents";

import { mapState } from "vuex";
import ProjectItem from "@/components/ProjectItem";
import SectionContacts from "@/components/SectionContacts";
import FormSection from "@/components/FormSection";

export default {
  mixins: [ViewAnimationEvents],
  components: {
    ProjectItem,
    SectionContacts,
    FormSection
  },
  computed: {
    ...mapState({
      projects: state => state.route.data.projects
    })
  }
}
</script>]

<style lang="scss" scoped>
  .portfolio {
    &__item {
      margin: 0;
      &:not(:last-child) {
        margin-bottom: var(--section-small-margin);
      }
    }
  }
</style>