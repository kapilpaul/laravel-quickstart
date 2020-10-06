<template>
  <div>
    <transition enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
      <div v-if="typeof $store.getters.validationErrors.errors !== 'undefined'">
        <div
          class="alert alert-danger"
          role="alert"
          v-if="$store.getters.validationErrors.errors.length !== 0"
        >
          <ul class="list-group" v-if="typeof $store.getters.validationErrors.errors === 'object'">
            <li v-for="(items, index) in $store.getters.validationErrors.errors" :key="index">
              <div v-if="typeof items === 'object' || typeof items === 'array'">
                <p
                  class="mb-0 animated fadeIn"
                  v-for="(item, index) in items"
                  :key="index"
                >{{ item }}</p>
              </div>

              <div v-if="typeof items === 'string'">
                <p class="mb-0 animated fadeIn">{{ items }}</p>
              </div>
            </li>
          </ul>
          <ul
            class="list-group"
            v-else-if="typeof $store.getters.validationErrors.errors === 'string'"
          >
            <li>
              <p class="mb-0">
                <i class="icon icon-hand-stop-o text-blue"></i>
                {{ $store.getters.validationErrors.errors }}
              </p>
            </li>
          </ul>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
ul.list-group {
  /* padding: 0 15px; */
}
.list-group li {
  display: block;
  padding: 0 15px;
}
.list-group li p {
  display: list-item;
}
</style>
