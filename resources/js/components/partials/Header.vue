<template>
  <div class="header">
    <div class="header-left">
      <a href="#">
        <img src="@/../img/sitelogo_login.png" alt="" />
      </a>
      <span class="logo-text">開発環境</span>
    </div>
    <div class="header-right">
      <div
        class="dropdown-menu"
        @mouseover="showMenu = true"
        @mouseleave="showMenu = false"
      >
        <div class="dropdown-btn">
          <span class="sBtn-text">{{$store.state.auth.authenticated ? $store.state.auth.user.name : ''}}さん</span>
          &nbsp;<i class="fas fa-caret-down"></i>
        </div>

        <transition name="slide">
          <ul class="dropdown-content" v-if="showMenu" style="display: block;">
            <li class="dropdown-item">
              <a class="logout" href="#" @click="doLogout">ログアウト</a>
            </li>
            <li class="dropdown-item">
              <a href="#">
                <span>検索条件のリセット</span><br />
                <span class="fs-10px text-gray">
                  各種一覧画面で検索実行時に、エラーが発生して画面操作ができなくなった場合は、このボタンを押して下さい。現在ログイン中の担当者が検索した全検索条件を消去します。
                </span>
              </a>
            </li>
          </ul>
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import ServiceAPI from "../../service/api";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
export default {
  setup() {
    const showMenu = ref(false);
    const router = useRouter();
    const store = useStore();
    const doLogout = () => {
      ServiceAPI.axiosCall("logout", {})
        .then((res) => {
          store.dispatch("auth/logout");
          router.push({ name: "login" }).then(() => {
            router.go();
          });
        })
        .catch((err) => {
          console.log(err);
        });
    };

    return { showMenu, doLogout };
  },
};




</script>

<style scoped>
.slide-enter-active {
  -moz-transition-duration: 0.3s;
  -webkit-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -moz-transition-timing-function: ease-in;
  -webkit-transition-timing-function: ease-in;
  -o-transition-timing-function: ease-in;
  transition-timing-function: ease-in;
}

.slide-leave-active {
  -moz-transition-duration: 0.3s;
  -webkit-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -moz-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
  -webkit-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
  -o-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
  transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
}

.slide-enter-to,
.slide-leave {
  max-height: 100px;
  overflow: hidden;
}

.slide-enter,
.slide-leave-to {
  overflow: hidden;
  max-height: 0;
}
</style>