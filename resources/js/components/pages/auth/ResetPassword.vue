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
                        <form class="login-form" @submit.prevent="callReset">
                            <div class="forgot-pw-note">
                                <p>
                                    メールアドレスに、パスワード変更用の確認コードを送りました。
                                </p>
                                <p>
                                    メールに記載された確認コードを入力し、新しいパスワードを設定して下さい。
                                </p>
                            </div>
                            <div class="form-inp">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="確認コード" v-model="reset.token">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="パスワード ※8-16文字の半角英数" v-model="reset.password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="パスワード(再入力)" v-model="reset.password_confirmation">
                                </div>
                            </div>
                            <div class="error-display" v-if="v$.reset.$errors.length">
                                <div><i class="fas fa-exclamation-triangle"></i></div>
                                <ul>
                                    <li v-for="(error, index) in v$.reset.$errors" :key="index">
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
import { useRouter, useRoute } from "vue-router";
export default {
  setup() {
    const { t } = useI18n();
    const router = useRouter();
    const route = useRoute();
    const reset = reactive({
      token: "",
      password:"",
      password_confirmation:"",
      hashCode: route.query.hash_code
    });
    
    const $externalResults = ref({});

    const rules = {
      reset: {
        token: {
          required: helpers.withMessage(
            t("validate.required", { label: "確認コード" }),
            required
          ),
        },
        password: {
          required: helpers.withMessage(
            t("validate.required", { label: "パスワード" }),
            required
          ),
        },
        password_confirmation: {
          required: helpers.withMessage(
            t("validate.required", { label: "パスワード(再入力)" }),
            required
          ),
        },
      },
    };

    const v$ = useVuelidate(rules, { reset }, { $externalResults });

    const callReset = async () => {
      v$.value.$clearExternalResults();
      if (!(await v$.value.$validate())) return;

      // refresh csrf-token
      let resToken = await ServiceAPI.axiosCall("csrfToken", {});
      if (resToken.error) {
        console.log("token error");
      }

      const res = ServiceAPI.axiosCall("reset_password", reset)
        .then((res) => {
          if (!res.error) {
            router.push({ name: 'reset_password_success'})
          } else {
            if(res.error.code == '422'){
              $externalResults.value = { reset: res.error.message}
            }else if(res.error.code == '401'){
              $externalResults.value = { reset: {password: res.error.message}}
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
        reset.token = "";
        reset.password = "";
        reset.password_confirmation = "";
        v$.value.$reset();
    };

    return { reset, v$, callReset, resetForgot };
  },
};
</script>

<style>
</style>