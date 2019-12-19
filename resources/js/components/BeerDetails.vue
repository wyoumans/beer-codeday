<template>
  <div ng-cloak>
    <div
      v-if="beer.image_url"
      class="block h-48 lg:h-auto lg:w-48 bg-contain bg-no-repeat bg-center overflow-hidden mb-6 mx-auto"
      :style="'background-image: url(\'' + beer.image_url + '\');min-height:255px;'"
    >
      <span class="hidden">{{ beer.name }}</span>
    </div>

    <p class="uppercase text-sm font-bold pt-6 pb-6 md:w-2/3 w-full mx-auto">Details</p>

    <div class="bg-white rounded border p-6 md:w-2/3 w-full mx-auto">
      <h2 class="text-gray-900 font-bold text-xl mb-2">
        {{ beer.name }}
      </h2>

      <p class="text-gray-700 text-sm font-bold uppercase mb-2">{{ beer.tagline }}</p>

      <p class="text-gray-700 text-base mb-2 overflow-auto" style="max-height:100px;">{{ beer.description }}</p>
    </div>

    <p class="uppercase text-sm font-bold pt-6 pb-3 md:w-2/3 w-full mx-auto">Pairings</p>

    <div class="flex flex-wrap">
      <recipe v-for="recipe in recipes" :recipe="recipe" :key="recipe.id"></recipe>
    </div>

    <div
      class="md:w-2/3 w-full mx-auto"
      v-if="recipes.length == 0"
    >
      No pairings found
    </div>

  </div>
</template>

<script>
import Recipe from "./Recipe";

export default {
  name: "beer-details",

  components: {
    Recipe
  },

  data() {
    return {
      beer: {},
      recipes: []
    };
  },

  created() {
    this.getBeer();
  },

  methods: {
    getBeer() {
      this.$Progress.start();

      axios.get("/api/beers/" + this.$route.params.id)
        .then(({ data }) => {
          this.beer = data.data;
          this.recipes = this.beer.recipes;
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
