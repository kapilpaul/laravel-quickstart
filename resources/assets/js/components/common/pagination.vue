<template>
  <div class="row" v-if="pageCount > 1">
    <div class="col-md-12">
      <paginate
        v-model="page"
        :page-count="pageCount"
        :click-handler="fetchMore"
        :prev-text="'Prev'"
        :next-text="'Next'"
        :container-class="'pagination float-right'"
        :page-class="'page-item'"
        :page-link-class="'page-link'"
        :prev-class="'page-item'"
        :prev-link-class="'page-link'"
        :next-class="'page-item'"
        :next-link-class="'page-link'"
      ></paginate>
    </div>
  </div>
</template>

<script>
import paginate from "vuejs-paginate";

export default {
  name: "pagination",
  props: ["setLocation", "url"],
  data() {
    return {
      pageNum: 1
    };
  },
  components: {
    paginate
  },
  computed: {
    page: {
      get() {
        return this.$store.getters.page;
      },
      set(value) {
        this.$store.dispatch("setPage", value);
      }
    },
    pageCount() {
      return this.$store.getters.pageCount;
    }
  },
  methods: {
    fetchMore(pagenum) {
      this.$store.dispatch("setPage", pagenum);
      this.$store.dispatch(this.setLocation, { url: this.url + pagenum });
    }
  }
};
</script>

<style scoped>
</style>