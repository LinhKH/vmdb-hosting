<template>
  <div class="wrapper">
    <div class="header">
      <div class="header-left">
        <a href="#">
          <img src="@/../img/sitelogo_login.png" alt="" />
        </a>
        <span class="logo-text">開発環境</span>
      </div>
    </div>
    <div class="sidebar-container"></div>
    <div class="main login-page">
      <div class="page-container">
        <div class="page-title-top">
          <p>パスワード再設定</p>
        </div>
        <div class="login-wrapper">
          <div class="login-container">
            <div class="login-header text-center">
              <img src="@/../img/sitelogo_login.png" alt="" />
              <span class="logo-text">開発環境</span>
            </div>
            <form class="login-form" @submit.prevent="callForgot">
              <div class="forgot-pw-note">
                <p>ログインIDを入力後、「送信」を押して下さい。</p>
                <p>
                  ログイン情報に登録されたメールアドレスへ、パスワード変更用の確認コードを送信します。
                </p>
              </div>
              <div class="form-inp">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="ログインID"
                    v-model="forgot.login_id"
                  />
                </div>
              </div>
              <div class="error-display" v-if="v$.forgot.$errors.length">
                <div><i class="fas fa-exclamation-triangle"></i></div>
                <ul>
                  <li v-for="(error, index) in v$.forgot.$errors" :key="index">
                    {{ error.$message }}
                  </li>
                </ul>
              </div>
              <div class="form-group text-center">
                <router-link
                  class="btn btn-gray w-per-100"
                  :to="{ name: 'login' }"
                >
                  ログイン画面へ
                </router-link>
                <button class="btn btn-gray w-per-100" @click="(event) => resetForgot(event)">
                  Reset
                </button>
                <button class="btn btn-primary w-per-100 font-w-bold">
                  送信
                </button>
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
    const forgot = reactive({
      login_id: "",
    });
    const store = useStore();
    const router = useRouter();
    const $externalResults = ref({});

    const rules = {
      forgot: {
        login_id: {
          required: helpers.withMessage(
            t("validate.required", { label: "ID" }),
            required
          ),
        },
      },
    };

    const v$ = useVuelidate(rules, { forgot }, { $externalResults });

    const callForgot = async () => {
      v$.value.$clearExternalResults();
      if (!(await v$.value.$validate())) return;

      // refresh csrf-token
      let resToken = await ServiceAPI.axiosCall("csrfToken", {});
      if (resToken.error) {
        console.log("token error");
      }

      const res = ServiceAPI.axiosCall("forgot", forgot)
        .then((res) => {
          if (!res.error) {
            router.push({ name: 'reset_password', query: { hash_code: res.response.hash_code }})
          } else {
            if(res.error.code == '422'){
              $externalResults.value = { forgot: res.error.message}
            }else if(res.error.code == '401'){
              $externalResults.value = { forgot: {login_id: res.error.message}}
            }
          }
        })
        .catch((err) => {
          console.log(err);
        });
      return res;
    };

    const resetForgot = (e) => {
        e.preventDefault();
        forgot.login_id = "";
        v$.value.$reset();
    };

    return { forgot, v$, callForgot, resetForgot };
  },
};
</script>

<style>
</style>