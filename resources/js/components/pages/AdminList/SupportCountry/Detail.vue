<template>
  <!-- {{supportCountry}} -->
    <div id="tab-2" class="tabcontent" style="display: block;">
        <div class="page-title-top">
            <p>対応国詳細</p>
        </div>
        <div class="block-content-wrapper">
            <div class="block-content">
                <div class="block-search-result w-per-60 m-auto">
                    <div class="edit-page-content">
                        <table class="table table-bordered table-fixed">
                            <tbody>
                                <tr>
                                    <td class="bg-gray text-center" style="width: 200px">ID</td>
                                    <td>{{ supportCountry.id }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">ステータス</td>
                                    <td><CommonMst :mstNm="`support_country_status`" v-model="supportCountry.status"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">国名</td>
                                    <td>{{ supportCountry.name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">国マスタ</td>
                                    <td>{{ supportCountry.support_country_master?.name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">タイプ</td>
                                    <td><CommonMst :mstNm="`support_country_item`" v-model="supportCountry.item_type"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">エリア</td>
                                    <td><CommonMst :mstNm="`support_country_area`" v-model="supportCountry.area_no"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">申込制限</td>
                                    <td><CommonMst :mstNm="`support_country_stop_yn`" v-model="supportCountry.stop_yn"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">SIM</td>
                                    <td>{{ supportCountry.sim_type }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">補足・注釈</td>
                                    <td>{{ supportCountry.notice }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">不備チェック</td>
                                    <td>{{ supportCountry.loss_check }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">国ISO</td>
                                    <td>{{ supportCountry.iso_code }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">注文番号</td>
                                   <td>{{ supportCountry.order_no }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">追加オプション</td>
                                   <td>{{ supportCountry.add_options }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">日数制限</td>
                                    <ThousandsSeparator :suffix="`日`" :number="supportCountry.rental_days_max"/>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">プラグタイプ</td>
                                    <td><CommonMst :mstNm="`plug_type`" v-model="supportCountry.plug_type"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">超値前</td>
                                    <td><CommonMst :mstNm="`order_just_before_yn`" v-model="supportCountry.just_before_status"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">ロッカー</td>
                                    <td><CommonMst :mstNm="`locker_flag`" v-model="supportCountry.locker_flag"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">デバイス選択</td>
                                    <td>{{ supportCountry.device_select_yn }}</td>
                                </tr>
                                <tr class="tb-title-row">
                                    <td colspan="2">
                                        <span>
                                            サイト制御
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">URL文字列</td>
                                    <td>{{ supportCountry.site_code }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">申込プルダウン</td>
                                    <td><CommonMst :mstNm="`display_yn`" v-model="supportCountry.site_order_flag"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">一覧ページ掲載</td>
                                    <td><CommonMst :mstNm="`display_yn`" v-model="supportCountry.site_list_flag"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">詳細ページ掲載</td>
                                    <td><CommonMst :mstNm="`display_yn`" v-model="supportCountry.site_detail_flag"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">管理画面申込プルダウン</td>
                                    <td><CommonMst :mstNm="`display_yn`" v-model="supportCountry.admin_order_flag"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">料金表示</td>
                                    <td><CommonMst :mstNm="`display_yn`" v-model="supportCountry.site_price_flag"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">備考</td>
                                    <td>{{ supportCountry.info }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">登録日時</td>
                                    <td>{{utils.formatDateTime(supportCountry.reg_dt)}}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray text-center">更新日付</td>
                                    <td>{{utils.formatDateTime(supportCountry.upd_dt)}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center group-btn">
                            <router-link :to="{name: 'support_country_list'}" class="btn btn-gray" title="一覧へ">一覧へ</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ServiceAPI from "@/service/api";
import CommonMst from "@/components/partials/CommonMst.vue";
import { useRoute } from "vue-router";
import { useStore } from 'vuex';
import { computed, ref } from "vue";
import ThousandsSeparator from "@/components/partials/ThousandsSeparator.vue";
import utils from '@/service/utils';
export default {
    components: { ThousandsSeparator, CommonMst },
    setup(){
        const route = useRoute();
        const supportCountry = ref({});
        const store = useStore();
        const commonMst = computed(() => store.state.common);
        const loadCommonMst = () => {
            let mst_id = ['support_country_status', 'support_country_item', 'support_country_area', 'support_country_stop_yn', 'plug_type', 'order_just_before_yn', 'locker_flag', 'display_yn', 'support_country_sim_type'];
            store.dispatch("common/getCommonMst", mst_id);
        }
        const getSupportCountry  = (id) => {
            ServiceAPI.axiosCall("support_country_detail", {id: id})
                .then((res) => {
                    if(!res.error){
                        supportCountry.value = res.response;
                    }
            })
            .catch((err) => {
                console.log(err);
            });
        }
        getSupportCountry(route.params.id);
        loadCommonMst();
        return {supportCountry, commonMst, utils};
    }

}
</script>

<style>

</style>