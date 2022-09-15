<template>
  <table class="table table-hover table-striped text-capitalize">
    <thead>
      <tr>
        <th v-for="key in thead" scope="col">{{ key }}</th>
      </tr>
    </thead>
    <tbody>
      <slot></slot>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ["thead"],
};
</script>
