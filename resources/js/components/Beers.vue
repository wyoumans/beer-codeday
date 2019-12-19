<template>
  <div class="flex flex-wrap" v-cloak>
    <beer v-for="beer in beers" :beer="beer" :key="beer.id"></beer>
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
      beers: []
    };
  },

  created() {
    this.getBeers();
  },

  methods: {
    getBeers() {
      this.loading = true;

      axios.get("/api/beers").then(({ data }) => {
        this.loading = false;
        this.beers = data.data;
      });
    }
  }
};
</script>
