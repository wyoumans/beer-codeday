<template>
  <div class="w-full md:w-1/3 flex flex-col lg:flex-row p-2 md:p-5">
    <div
      class="block h-48 lg:h-auto lg:w-48 flex-none bg-cover bg-no-repeat bg-center rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden bg-gray-100 border lg:border-r-0 border-gray-400"
      :style="'background-image: url(\'' + image + '\');min-height:255px;'"
    >
      <span class="hidden">{{ recipe.label }}</span>
    </div>

    <div
      class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-1 flex-col justify-between leading-normal"
    >
      <div class="mb-8">
        <h2 class="text-gray-900 font-bold text-xl mb-2">{{ recipe.label }}</h2>

        <p class="text-gray-700 text-sm font-bold uppercase mb-2 break-all">{{ recipe.source }}</p>

        <p>
          <a :href="recipe.share_url" target="_blank">See full recipe</a>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "recipe",

  props: ["recipe"],

  computed: {
    image() {
      return this.recipe.image_url
        ? this.recipe.image_url
        : "/images/missing.png";
    }
  }
};
</script>
