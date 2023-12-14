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
            <form class="login-form">
              <div class="forgot-pw-note">
                <p>パスワード再設定が完了しました。</p>
              </div>
              <div class="form-group text-center">
                <router-link class="btn btn-gray w-per-100" :to="{ name: 'login' }">
                  ログイン画面へ
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
import { useRouter, useRoute } from "vue-router";
export default {
  setup() {
    const { t } = useI18n();
    const router = useRouter();
    const route = useRoute();
    const reset = reactive({
      token: "",
      password: "",
      password_confirmation: "",
      hashCode: route.query.hash_code,
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
            router.push({ name: "reset_password_success" });
          } else {
            if (res.error.code == "422") {
              $externalResults.value = { reset: res.error.message };
            } else if (res.error.code == "401") {
              $externalResults.value = {
                reset: { password: res.error.message },
              };
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