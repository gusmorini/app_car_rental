<template>
  <div :class="classAlert" role="alert">
    <template v-if="typeof text == 'object'">
      <div v-for="e, key in text" :key="key">{{ e[0] }}</div>
    </template>
    <template v-else>
      {{ text }}
    </template>
  </div>
</template>

<script>
export default {
  props: ['type', 'text'],
  computed: {
    classAlert() {
      return 'alert alert-' + this.type;
    }
  }
}
</script>