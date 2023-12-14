<template>
  <Datepicker
    auto-apply
    :format="'yyyy/MM/dd'"
    v-model="date_val"
    class="wrap-date"
    @update:model-value="handleDate"
    :enable-time-picker="false"
    :timezone="$clientTimeZone"
  />
</template>

<script>
import { ref, watch } from "vue";
import moment from "moment";
export default {
  props: {
    modelValue: { type: String, required: true },
  },
  setup(props, context) {
    const date_val = ref();
    const handleDate = (modelData) => {
      context.emit("update:modelValue", formatDate(modelData, "date_to_str"));
    };
    const formatDate = (data, type = "str_to_date") => {
      let result = data;
      if (data) {
        let format = "YYYY/MM/DD";
        if (type == "str_to_date") {
          result = moment(data, format).toString();
        } else {
          result = moment(data).format(format);
        }
      }
      return result;
    };

    watch(
      () => props.modelValue,
      (newValue) => {
        date_val.value = formatDate(newValue, "str_to_date");
      },
      { immediate: true }
    );

    return { handleDate, formatDate, date_val };
  },
};
</script>

<style>
</style>