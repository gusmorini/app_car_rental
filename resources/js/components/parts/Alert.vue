<template>
  <div :class="classAlert" role="alert">
    <template v-if="typeof data.message == 'object'">
      <div v-for="e, key in data.message" :key="key">{{ e[0] }}</div>
    </template>
    <template v-else>
      {{ data.message }}
    </template>
  </div>
</template>

<script>
export default {
  props: ['type', 'data'],
  computed: {
    classAlert() {
      return `alert alert-${this.data.type ? this.data.type : 'primary'}`;
    }
  }
}
</script>