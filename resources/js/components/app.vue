<template>
  <component :is="layout">
    <router-view></router-view>
  </component>
  <base-loading></base-loading>
  <notifications-list />
</template>

<script>
import { computed } from "vue";
import { useRoute } from "vue-router";
import BaseLoading  from "./plugins/loading.vue";
import notificationsList from "./plugins/notification/NotificationsList.vue";
export default {
  components: { BaseLoading, notificationsList },
  setup() {
    const route = useRoute();
    const defaultLayout = "default";
    const layout = computed(() => {
      return (route.meta.layout || defaultLayout) + "-layout";
    });
    return { layout };
  },
};
</script>

<style>
</style>