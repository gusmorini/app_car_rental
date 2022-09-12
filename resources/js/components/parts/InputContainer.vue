<template>
  <div>
    <label :for="id" class="form-label">{{ title }}</label>
    <slot></slot>
    <div :id="idhelp" class="form-text">
      {{ helptext }}
    </div>
  </div>
</template>

<script>
export default {
  props: ['type', 'id', 'title', 'idhelp', 'helptext'],
}
</script>