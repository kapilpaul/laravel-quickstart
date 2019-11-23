<template>
  <div>
    <button
      v-if="this.$store.getters.submitted === false"
      class="btn btn-primary min-width-125 mt-15 mb-15"
      type="submit"
    >{{btnname}}</button>

    <button
      v-else-if="this.$store.getters.submitted === true"
      class="btn btn-primary min-width-125 mb-15"
      disabled
    >
      <i class="fa fa-spinner fa-spin"></i>
      Processing
    </button>
  </div>
</template>

<script>
export default {
  name: "btn-submit",
  props: {
    btnname: {
      type: String,
      default: "Submit"
    }
  }
};
</script>

<style scoped>
</style>