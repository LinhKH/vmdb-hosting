<template>
    <vue-awesome-paginate
      :total-items="totalItems"
      v-model="page"
      :items-per-page="itemsPerPage"
      :max-pages-shown="5"
      :on-click="onClickHandler"
    >
      <template #prev-button>
        <a><i class="fas fa-chevron-left"></i></a>
      </template>
      <template #next-button>
        <a><i class="fas fa-chevron-right"></i></a>
      </template>
    </vue-awesome-paginate>
</template>

<script>
import { ref, toRefs, watch } from "vue";
export default {
  props: {
    totalItems: { type: Number, required: true },
    itemsPerPage: { type: Number, required: true },
    modelValue: { type: Number, required: true },
  },
  setup(props, context) {
    const page = ref(1);
    const { totalItems, itemsPerPage } = toRefs(props);
    const onClickHandler = () => {
      context.emit("update:modelValue", page.value);
      context.emit("onPageChange", page.value);
    };

    watch(
      () => props.modelValue,
      (newValue) => {
        page.value = newValue;
      }
    );

    return {
      page,
      totalItems,
      itemsPerPage,
      onClickHandler,
    };
  },
};
</script>
