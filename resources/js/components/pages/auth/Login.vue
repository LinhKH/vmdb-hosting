<template>
  <div class="wrapper">
    <div class="sidebar-container"></div>
    <div class="main login-page">
      <div class="page-container">
        <div class="login-wrapper">
          <div class="login-container">
            <div class="login-header text-center">
              <img src="@/../img/sitelogo_login.png" alt="" />
              <span class="logo-text">開発環境</span>
            </div>
            <form class="login-form" @submit.prevent="callLogin">
              <div class="form-inp">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="ID"
                    v-model="login.login_id"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="password"
                    class="form-control"
                    placeholder="パスワード"
                    v-model="login.password"
                  />
                </div>
              </div>
              <div class="error-display" v-if="v$.login.$errors.length">
                <div><i class="fas fa-exclamation-triangle"></i></div>
                <ul>
                  <li v-for="(error, index) in v$.login.$errors" :key="index">
                    {{ error.$message }}
                  </li>
                </ul>
              </div>
              <div class="form-group text-center">
                <button class="btn btn-primary w-per-100 font-w-bold">
                  ログイン
                </button>
              </div>
              <div class="form-group text-center">
                <router-link class="forget-pw-link" :to="{ name: 'forgot'}">
                  パスワードの再設定はこちら
                </router-link>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>




<script>
import { reactive, ref } from "vue";
import { useI18n } from "vue-i18n";
import { useVuelidate } from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";
import ServiceAPI from "../../../service/api";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
export default {
  setup() {
    const { t } = useI18n();
    const login = reactive({
      login_id: "",
      password: "",
    });
    let errorLogin = ref("");
    const store = useStore();
    const router = useRouter();
    const $externalResults = ref({})

    const rules = {
      login: {
        login_id: {
          required: helpers.withMessage(
            t("validate.required", { label: "ID" }),
            required
          ),
        },
        password: {
          required: helpers.withMessage(
            t("validate.required", { label: "パスワード" }),
            required
          ),
        },
      },
    };

    const v$ = useVuelidate(rules, { login },{ $externalResults });

    const callLogin = async () => {
      v$.value.$clearExternalResults();
      if(!await v$.value.$validate()) return;

      // refresh csrf-token
      let resToken = await ServiceAPI.axiosCall("csrfToken", {});
      if (resToken.error) {
        console.log("token error");
      }

      const res = ServiceAPI.axiosCall("login", login)
        .then((res) => {
          if (!res.error) {
            store.dispatch("auth/login").then(() => {
              router.push({ name: "home" });
            });
          } else {
            if(res.error.code == '422'){
              $externalResults.value = { login: res.error.message}
            }else if(res.error.code == '401'){
              $externalResults.value = { login: {login_id: res.error.message}}
            }
          }
        })
        .catch((err) => {
          console.log(err);
        });
      return res;
    };

    return { login, errorLogin, v$, callLogin };
  },
};
</script>

<style>
.error {
  color: red;
}
</style>