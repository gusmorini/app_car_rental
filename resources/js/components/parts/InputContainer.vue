<template>
  <div class="mb-4">
    <label :for="id" class="form-label">{{ title }}</label>
    <slot></slot>
    <div :id="id+'-help'" class="form-text">
      {{ helptext }}
    </div>
  </div>
</template>

<script>
export default {
  props: ['type', 'id', 'title', 'helptext'],
}
</script>