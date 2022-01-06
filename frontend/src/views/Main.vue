<template lang="pug">

SectionHome
About
Service
Projects(v-if="projects" :projects="projects")
Contacts(v-if="contacts" :contacts="contacts")

</template>

<script>
  import SectionHome from "@/components/SectionHome";
  import About from "@/components/sections/About";
  import Service from "@/components/SectionService";
  import Projects from "@/components/sections/Projects";
  import Contacts from "@/components/sections/Contacts";

  import { mapGetters, mapState } from "vuex";

  export default {
    components: {
      SectionHome,
      Projects,
      Contacts, 
      About,
      Service
    },
    computed: {
      ...mapGetters({
        contacts: 'getContacts'
      }),
      ...mapState({
        projects: state => state.routeData.projects
      })
    }
  }
</script>

<style lang="scss">

</style>