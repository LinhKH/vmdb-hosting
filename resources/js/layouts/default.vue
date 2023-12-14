<template>
  <div id="wrapper">
    <Header/>
    <div class="sidebar-container"></div>
    <div class="main">
      <div class="page-container">
        <TopNav/>
          <slot />
        <Footer/>
      </div>
    </div>

    
  </div>
</template>

<script>
import Header from '../components/partials/Header.vue'
import TopNav from '@/components/partials/TopNav.vue'
import Footer from '@/components/partials/Footer.vue'
export default {
  components: { Header, TopNav, Footer},
};
</script>

<style>
</style>