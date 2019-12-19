<template>
  <div>
    <div class="flex flex-wrap" v-cloak>
      <beer v-for="beer in beers" :beer="beer" :key="beer.id"></beer>
    </div>

    <div class="text-center">
      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded inline-block w-auto mt-6"
        @click.prevent="getBeers"
        v-if="showMoreButton"
      >
        More Beer!
      </button>
    </div>
  </div>
</template>

<script>
import Beer from "./Beer";

export default {
  name: "beers",

  components: {
    Beer
  },

  data() {
    return {
      beers: [],
      page: -1,
      showMoreButton: true
    };
  },

  created() {
    this.getBeers();
  },

  methods: {
    getBeers() {
      this.page++;
      this.loading = true;
      this.$Progress.start();

      axios.get("/api/beers?page=" + this.page)
        .then(({ data }) => {
          this.loading = false;
          this.beers = this.beers.concat(data.data);
          this.$Progress.finish();

          if(this.beers.length < 15) {
            this.showMoreButton = false;
          }
        })
        .catch(error => {
          this.$Progress.fail();
        });
    }
  }
};
</script>
