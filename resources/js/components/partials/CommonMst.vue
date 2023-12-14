<template>
<span :class="commonMst[mstNm]?.[modelValue]?.['color']">{{commonMst[mstNm]?.[modelValue]?.['disp_value']}}</span>
</template>

<script>
import { ref, toRefs, watch, computed } from "vue";
import { useStore } from "vuex";
export default {
  props: {
    mstNm: { type: String, required: true },
    modelValue: { type: [String, Number], required: true, default: "" },
  },
  setup(props, context) {
    const store = useStore();
		const commonMst = computed(() => store.state.common);
    const page = ref(1);
    const { mstNm } = toRefs(props);

    watch(
      () => props.modelValue,
      (newValue) => {
        page.value = newValue;
      }
    );

    return {
      commonMst,
      mstNm
    };
  },
};
</script>
