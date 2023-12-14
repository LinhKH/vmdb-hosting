<template>
  
  <div class="tab tab-list bg-blue-default">
    <template v-for="(item, key) in current_sub_menu" :key="key">
      <router-link v-if="item.exact_active" :to="{ name: item.link}" exact-active-class="active" class="tablinks tab-btn-1">{{item.text}}</router-link>
      <router-link v-else :to="{ name: item.link}" active-class="active" class="tablinks tab-btn-1">{{item.text}}</router-link>
    </template>
  </div>

</template>

<script>
import { ref, watch, computed } from "vue";
import { useStore } from 'vuex'
export default {
   props: {
    main_menu: { type: String, default: "" },
  },
  setup(props) {
    
    const store = useStore()
    const userInfo = computed(() => store.state.auth.user);
    const sub_menu = {
      home: [
        {
          link: "home",
          text: "ホーム",
        },
      ],
      call_list: [
        {
          link: "call_list",
          text: "コンタクト管理",
        },
        {
          link: "call_csv_upload",
          text: "CSVコンタクト登録",
        },
      ],
      order_change_request_list: [
        {
          link: "order_change_request_list",
          text: "変更申請",
        },
        {
          link: "order_request_list",
          text: "キャンセル申請",
        },
        {
          link: "member_list",
          text: "顧客管理",
        },
        {
          link: "contact_list",
          text: "お問い合わせ管理",
        },
        {
          link: "gobeyonder_list",
          text: "GO-BEYONDER",
        },
        {
          link: "questionnaire_new_list",
          text: "アンケート管理",
        },
        {
          link: "questionnaire_rainbow_list",
          text: "Rainbowアンケート",
        },
      ],
      order_center_cvs_update: [
        {
          link: "order_center_cvs_update",
          text: "出荷処理場所一括変更",
        },
        {
          link: "sheet_create",
          text: "CSV.PDF作成",
        },
        {
          link: "sheet_output",
          text: "CSV.PDFダウンロード",
        },
        {
          link: "b2csv_upload",
          text: "国内宅配CSVアップロード",
        },
        {
          link: "slip_number_search",
          text: "伝票番号検索",
        },
        {
          link: "order_delivery_list",
          text: "出荷予定一覧",
        },
        {
          link: "order_kt_cvs_update",
          text: "KT・WIDEステータス変更",
        },
        {
          link: "order_contract_list",
          text: "電気通信事業者書面管理",
        },
      ],
      order_list: [
        {
          link: "order_list",
          text: "受注管理",
        },
        {
          link: "order_cap_addition_list",
          text: "容量受注一覧",
        },
        {
          link: "order_contract_plan_list",
          text: "容量プラン変更履歴",
        },
        {
          link: "order_sales_list",
          text: "回線管理一覧",
        },
        {
          link: "order_vmbs_just_before_list",
          text: "直前在庫",
        },
        {
          link: "申込停止情報",
          text: "order_control_list_edit",
        },
        {
          link: "order_control_option_list_edit",
          text: "申込停止情報(OP)",
        },
        {
          link: "order_remarks_list",
          text: "受注処理",
        },
        {
          link: "order_seven_support_list",
          text: "セブン‐イレブン対応一覧",
        },
        {
          link: "order_money_list",
          text: "料金管理",
        },
        {
          link: "order_demand_list",
          text: "確定料金管理",
        },
        {
          link: "order_mail_ng_list",
          text: "メールNGリスト",
        },
        {
          link: "mail_csv_upload",
          text: "メール一括配信",
        },
        {
          link: "event_code_whitelist",
          text: "イベコ検索",
        },
        {
          link: "white_list_detail",
          text: "イベコ実績",
        },
        {
          link: "event_code_detail",
          text: "追加情報実績",
        },
        {
          link: "whitelist",
          text: "イベコ設定",
        },
        {
          link: "irregular_order_csv_upload",
          text: "イレギュラー料金一括登録",
        },
      ],
      trouble_list: [
        {
          link: "trouble_list",
          text: "障害管理",
        },
      ],
      report_order_sumally: [
        {
          link: "report_order_sumally",
          text: "受注集計",
        },
        {
          link: "report_accounting",
          text: "当月実績",
        },
        {
          link: "report_reg_from",
          text: "申込場所",
        },
        {
          link: "report_country",
          text: "プラン集計",
        },
        {
          link: "report_all_countries",
          text: "国別集計",
        },
        {
          link: "report_group",
          text: "周遊別集計",
        },
        {
          link: "report_return_place",
          text: "受取場所",
        },
        {
          link: "report_option",
          text: "オプション集計",
        },
        {
          link: "report_agency",
          text: "代理店成績",
        },
        {
          link: "report_company",
          text: "企業集計",
        },
        {
          link: "report_company_summary",
          text: "企業サマリ",
        },
        {
          link: "report_factor",
          text: "要因分析",
        },
        {
          link: "report_member_sumally",
          text: "リピート分析",
        },
        {
          link: "report_travel_purpose",
          text: "渡航目的",
        },
        {
          link: "report_member_belong",
          text: "登録企業",
        },
        {
          link: "report_member_mail_setting",
          text: "受信設定",
        },
      ],
      agency_list: [
        {
          link: "agency_list",
          text: "代理店管理",
        },
        {
          link: "company_list",
          text: "企業管理",
        },
        {
          link: "company_bill_master_change_list",
          text: "企業請求情報",
        },
        {
          link: "capacity_coupon_list",
          text: "容量クーポン",
        },
        {
          link: "bill_perfect_account_list",
          text: "P口座",
        },
        {
          link: "company_approval_csv_upload",
          text: "反社チェック",
        },
        {
          link: "rep_list",
          text: "レップ管理",
        },
        {
          link: "download_list",
          text: "ダウンロード",
        },
        {
          link: "order_csv_upload",
          text: "CSV受注登録",
        },
        {
          link: "contact_biz_cloud_list",
          text: "Biz/Cloud問合せ",
        },
        {
          link: "contact_agent_list",
          text: "Agent問合せ",
        },
        {
          link: "url_list",
          text: "URL一覧",
        },
      ],
      campaign_list: [
        {
          link: "campaign_list",
          text: "端末キャンペーン管理",
        },
        {
          link: "campaign_csv_list",
          text: "CSV端末料金設定",
        },
      ],
      airport_charge_master_list: [
        {
          link: "airport_charge_master_list",
          text: "独自料金管理",
        },
      ],
      admin_list: [
        {
          link: "admin_list",
          text: "担当者管理",
          exact_active:1
        },
        {
          link: "support_country_list",
          text: "対応国管理",
        },
        {
          link: "support_country_group_list",
          text: "周遊国管理",
        },
        {
          link: "product_list",
          text: "商材管理",
        },
        {
          link: "terminal_list",
          text: "端末管理",
        },
        {
          link: "option_list",
          text: "オプション管理",
        },
        {
          link: "option_from_list",
          text: "オプション長期",
        },
        {
          link: "option_plan_list",
          text: "オプションプラン",
        },
        {
          link: "place_list",
          text: "場所管理",
        },
        // {
        //   link: "place_common_list",
        //   text: "受取/返却場所管理",
        // },
        // {
        //   link: "api_cache_list",
        //   text: "APIキャッシュ管理",
        // },
      ],
    };
    const current_sub_menu = ref([]);
     watch(
      () => props.main_menu,
      (main_menu) => {
        let temp = [];
        current_sub_menu.value = [];
        sub_menu[main_menu].forEach(item => {
          if(userInfo.value.menu.indexOf(item.link) != -1){
            temp.push(item);
          }
        });
        current_sub_menu.value = temp;
      },
      {immediate: true}
    );

    return { current_sub_menu };
  },
};
</script>

<style>
</style>