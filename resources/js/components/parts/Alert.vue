<template>
  <div :class="classAlert" role="alert">
    <strong>{{title}}</strong>
    <hr />
    {{ message }}
  </div>
</template>

<script>
export default {
  props: ['type', 'message', 'title'],
  computed: {
    classAlert() {
      return `alert alert-${this.type ? this.type : 'warning'}`;
    }
  }
}
</script>