<template lang="pug">
SelectedProjectsDesktop(v-if="$window.innerWidth >= $breakpoints.xl" :active="active" :projects="projects")
SelectedProjectsMobile(v-else :active="active" :projects="projects")
</template>

<script>
import SelectedProjectsDesktop from "@/components/SelectedProjectsDesktop";
import SelectedProjectsMobile from "@/components/SelectedProjectsMobile";

export default {
  props: {
    active: {
      type: Boolean,
      required: true
    }
  },
  components: {
    SelectedProjectsDesktop,
    SelectedProjectsMobile
  },
  computed: {
    projects() {
      return this.$store.state.route.data.selected_projects?.map(project => {
        return {
          name: project.name,
          image: project.preview_images[0],
          slug: project.slug
        }
      })
    }
  }
}
</script>