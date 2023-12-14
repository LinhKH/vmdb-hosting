<template>
  <template v-if="val === 0"> なし </template>
  <template v-else>
    <span class="text-red bold">{{ $filters.formatNumber(val)}}</span>{{suffix}}
  </template>
</template>

<script>
import { ref, computed, watch, inject } from "vue";
export default {
  props: {
    number: { type: Number, default: 0 },
    suffix: { type: String, default: "" },
  },
  setup(props) {
    const val = ref(props.number);
    const suffix = ref(props.suffix);

    watch(
      () => props.number,
      (selection) => {
        val.value = selection;
      }
    );

    return { val, suffix };
  },
};
</script>

<style>
</style>