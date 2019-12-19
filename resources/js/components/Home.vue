<template>
  <div v-cloak>
    <p class="uppercase text-sm font-bold pl-2 md:pl-5">Random Selection</p>
    <div class="flex flex-col md:flex-row">
      <beer :beer="beer"></beer>

      <div class="w-full md:w-1/2 p-2 md:p-5">
        <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-4 border border-blue-700 rounded inline-block w-auto"
          @click.prevent="getRandomBeer"
        >See a new random selection</button>
        <br />
        <router-link
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-4 border border-blue-700 rounded inline-block w-auto hover:text-white"
          to="/beers"
        >See all beers</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import Beer from "./Beer";

export default {
  name: "home",

  components: {
    Beer
  },

  created() {
    this.getRandomBeer();
  },

  data() {
    return {
      beer: {}
    };
  },

  methods: {
    getRandomBeer() {
      this.$Progress.start();

      axios
        .get("/api/beers/random")
        .then(({ data }) => {
          this.beer = data.data;
          this.$Progress.finish();
        })
        .catch(error => {
          this.$Progress.fail();
        });
    }
  }
};
</script>
