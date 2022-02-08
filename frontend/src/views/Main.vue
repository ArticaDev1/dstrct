<template lang="pug">
SectionHome
SectionAbout
SectionService
SectionProjectsPreview
FormSection(:figure="false")
SectionContacts
</template>

<script>
import ViewAnimationEvents from "@/mixins/ViewAnimationEvents";

import SectionHome from "@/components/SectionHome";
import SectionAbout from "@/components/SectionAbout";
import SectionService from "@/components/SectionService";
import SectionProjectsPreview from "@/components/SectionProjectsPreview";
import SectionContacts from "@/components/SectionContacts";
import FormSection from "@/components/FormSection";

export default {
  mixins: [ViewAnimationEvents],
  components: {
    SectionHome,
    SectionAbout,
    SectionService,
    SectionProjectsPreview,
    SectionContacts,
    FormSection
  }
}
</script>

<style lang="scss" scoped>

</style>