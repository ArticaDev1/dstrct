<template lang="pug">

h2.title.color-muted-3.mb-45
  slot

</template>

<script>
export default {
  name: 'SmallSectionTitle'
}
</script>

<style lang="scss" scoped>
.title {
  font-size: var(--base-font-size);
  line-height: var(--base-line-height);
}
</style>