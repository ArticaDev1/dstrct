<template lang="pug">
button.nav-toggle(
  type="button" 
  @click="setNavigationActive(!navigationActive)"
  :class="{'navActive': navigationActive, 'navVisible': navigationVisible, 'background': background }")
  span 
  span 
</template>

<script>
import { mapMutations, mapState } from 'vuex';

export default {
  props: {
    background: {
      type: Boolean,
      required: true
    }
  },
  methods: {
    ...mapMutations({
      setNavigationActive: 'navigation/ACTIVE',
    })
  },
  computed: {
    ...mapState({
      navigationActive: state => state.navigation.active,
      navigationVisible: state => state.navigation.visible
    })
  }
}
</script>

<style lang="scss">
.nav-toggle {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  padding: 19px 12px;
  margin: -19px -12px;
  gap: 5px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  color: var(--color-accent-1);
  transition: color var(--trs-1), background-color var(--trs-2);
  position: relative;
  &::before {
    content: '';
    display: block;
    width: 16px;
    height: 1px;
    border-radius: 0.5px;
    background-color: var(--color-base);
    position: absolute;
    top: calc(50% - 0.5px);
    left: calc(50% - 8px);
    opacity: 0;
    transform: scaleX(0);
    transition: opacity var(--trs-1), transform var(--trs-1);
  }
  span {
    display: block;
    width: 36px;
    height: 3px;
    border-radius: 3px;
    background-color: currentColor;
    transition: transform var(--trs-1);
  }
  &[data-touch], &[data-hover] {
    color: var(--color-accent-2);
  }
  &[data-hover] {
    &:not(.navActive):not(.navVisible) {
      &::before {
        opacity: 1;
        transform: scaleX(1);
      }
      span {
        &:first-child {
          transform: translateY(-4px);
        }
        &:last-child {
          transform: translateY(4px);
        }
      }
    }
  }
  &.navVisible {
    span {
      transition: transform var(--trs-2);
    }
  }
  &.navActive {
    span {
      transition: transform var(--trs-3);
      &:first-child {
        transform: translateY(4px) rotate(-45deg) scaleX(0.7);
      }
      &:last-child {
        transform: translateY(-4px) rotate(45deg) scaleX(0.7);
      }
    }
  }
  &.background {
    background-color: rgba(62, 62, 62, 0.5);
  }
  @include media-breakpoint-down(sm) {
    &.navActive {
      span {
        transition: transform var(--trs-2);
      }
    }
  }
}
</style>