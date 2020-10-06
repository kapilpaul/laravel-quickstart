<template>
  <div class="form-group">
    <label>{{ label }}</label>
    <small class="text-muted d-block mb-10" v-if="helptext !== ''">{{helptext}}</small>

    <input
      :type="type"
      class="form-control"
      :name="name"
      :placeholder="placeholder"
      :required="required"
      @input="$emit('input', $event.target.value)"
      :value="value"
    />
  </div>
</template>

<script>

export default {
  props: {
    label: {
      type: String,
      default: ""
    },
    name: {
      type: String,
      default: ""
    },
    placeholder: {
      type: String,
      default: ""
    },
    value: {
      type: String,
      default: ""
    },
    required: {
      type: Boolean,
      default: false
    },
    type: {
      type: String,
      default: "text"
    },
    helptext: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      inputData: ""
    };
  },
  components: {
  }
};
</script>

<style lang="scss" scoped>
.d-block {
  display: block;
}
</style>