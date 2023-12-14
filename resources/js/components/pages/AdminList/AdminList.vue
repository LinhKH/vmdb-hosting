<template>
<NavBar :main_menu="'admin_list'"/>
<router-view></router-view>

</template>

<script>
import NavBar from '@/components/partials/SecondNav.vue';
export default {
    components: {NavBar}
};
</script>

<style>
</style>