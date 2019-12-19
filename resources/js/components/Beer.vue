<template>
  <div class="w-full md:w-1/2 flex flex-col lg:flex-row p-2 md:p-5">
    <router-link
      class="block h-48 lg:h-auto lg:w-48 flex-none bg-contain bg-no-repeat bg-center rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden bg-gray-100 border lg:border-r-0 border-gray-400"
      :style="'background-image: url(\'' + image + '\');min-height:255px;'"
      :to="href"
    >
      <span class="hidden">{{ beer.name }}</span>
    </router-link>

    <div
      class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-1 flex-col justify-between leading-normal"
    >
      <div class="mb-8">
        <h2 class="text-gray-900 font-bold text-xl mb-2">
          <router-link :to="href">{{ beer.name }}</router-link>
        </h2>
        <p class="text-gray-700 text-sm font-bold uppercase mb-2">{{ beer.tagline }}</p>

        <p class="text-gray-700 text-base mb-2 overflow-auto" style="max-height:100px;">{{ beer.description }}</p>

        <p><router-link :to="href">See food pairings</router-link></p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "beer",

  props: ["beer"],

  computed: {

    href() {
      return '/beers/' + this.beer.id;
    },

    image() {
      return this.beer.image_url ? this.beer.image_url : '/images/missing.png';
    }
  }
};
</script>
