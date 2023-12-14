<template>
  <div class="block-links-direc">
    <router-link :to="{ name: 'home' }" active-class="active"
      >ホーム</router-link
    >
    <router-link to="/" active-class="active">コンタクト管理</router-link>
    <router-link to="/" active-class="active">顧客管理</router-link>
    <router-link to="/" active-class="active">出荷管理</router-link>
    <router-link to="/" active-class="active">受注管理</router-link>
    <router-link to="/" active-class="active">障害管理</router-link>
    <router-link to="/" active-class="active">集計</router-link>
    <router-link to="/" active-class="active">アフィリエイト</router-link>
    <router-link to="/" active-class="active">キャンペーン</router-link>
    <router-link to="/" active-class="active">空港システム</router-link>
    <router-link to="/admin_list" active-class="active"
      >システム管理</router-link
    >
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>