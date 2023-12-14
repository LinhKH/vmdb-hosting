<template>
<div id="tab-9" class="tabcontent" style="display: block;">
    <div class="page-title-top">
        <p>場所詳細</p>
    </div>
    <div class="block-content-wrapper">
        <div class="block-content">
            <div class="block-search-result w-per-80 m-auto">
                <div class="edit-page-content">
                    <table class="table table-bordered">
                        <colgroup>
                            <col style="width: 80px;">
                            <col style="width: 100px;">
                            <col style="width: 250px;">
                            <col style="width: 170px;">
                            <col style="width: 250px;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td class="bg-gray" colspan="2">ID</td>
                                <td class="">{{ place.id }}</td>
                                <td class="bg-gray">地域</td>
                                <td class=""><CommonMst :mstNm="`place_local_area`" v-model="place.local_area_id"></CommonMst></td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">場所マスタ</td>
                                <td class="" colspan="3">{{ place.place_master?.place_master_name }}</td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">場所名</td>
                                <td class="">{{ place.name }}</td>
                                <td class="bg-gray">短縮場所名</td>
                                <td class="">{{ place.name_short }}</td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">受取用説明</td>
                                <td class="">{{ place.receive_place_remarks }}</td>
                                <td class="bg-gray">返却用説明</td>
                                <td class="">{{ place.return_place_remarks }}</td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">ターミナル</td>
                                <td class=""><CommonMst :mstNm="`place_terminal_name`" v-model="place.terminal_name_id"></CommonMst></td>
                                <td class="bg-gray">ターミナル略称</td>
                                <td class="">{{ place.terminal_name_short }}</td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">カウンタータイプ</td>
                                <td class=""><CommonMst :mstNm="`place_counter_type`" v-model="place.counter_type"></CommonMst></td>
                                <td class="bg-gray">返却ボックス</td>
                                <td class=""><CommonMst :mstNm="`existence_yn`" v-model="place.return_box_yn"></CommonMst></td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">状態</td>
                                <td class=""><CommonMst :mstNm="`status_nq`" v-model="place.status"></CommonMst></td>
                                <td class="bg-gray">受渡手数料無料</td>
                                <td class=""><CommonMst :mstNm="`usage_yn`" v-model="place.free_status"></CommonMst></td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">受取料金</td>
                                <td class="text-right">{{ $filters.formatNumber(place.add_receive_money) }} 円</td>
                                <td class="bg-gray">返却料金</td>
                                <td class="">{{ $filters.formatNumber(place.add_return_money) }} 円</td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">拠点</td>
                                <td class=""><CommonMst :mstNm="`location_io`" v-model="place.location"></CommonMst></td>
                                <td class="bg-gray">タイプ</td>
                                <td class=""><CommonMst :mstNm="`place_type`" v-model="place.type"></CommonMst></td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">サイト表示</td>
                                <td class=""><CommonMst :mstNm="`site_display_yn`" v-model="place.site_status"></CommonMst></td>
                                <td class="bg-gray">倉庫利用</td>
                                <td class=""><CommonMst :mstNm="`usage_yn`" v-model="place.stock_status"></CommonMst></td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">申込期限</td>
                                <td class="">
                                    <span v-if="place.limit_status == 'Y'">
                                        {{ $filters.formatNumber(place.limit_day) }}日前
                                        {{ place.limit_time != '' ? place.limit_time +'時' : '' }}
                                        迄
                                    </span>
                                    <span v-if="place.limit_status != 'Y'">利用しない</span>
                                </td>
                                <td class="bg-gray">直前在庫</td>
                                <td class="">
                                    <span v-if="place.just_before_status == 'S'">
                                        {{ $filters.formatNumber(place.just_before_day) }}日前 
                                        {{ place. just_before_time != '' ? place. just_before_time +'時' : '' }}
                                        迄
                                    </span>
                                    <span v-if="place.just_before_status != 'S'">利用しない</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">在庫連動</td>
                                <td class="">
                                    <span v-if="place.stock_ctrl_yn == 'Y'">{{ place.stock_ctrl_buffer_day != '' ? '利用する' + place.stock_ctrl_buffer_day +'日' : '' }}</span>
                                    <span v-if="place.stock_ctrl_yn != 'Y'">利用しない</span>
                                </td>
                                <td class="bg-gray">成田空港判別</td>
                                <td class=""><CommonMst :mstNm="`possible_narita_yn`" v-model="place.possible_narita_yn"></CommonMst></td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">事前受取最大期間</td>
                                <td colspan="3">
                                    通常:{{ $filters.formatNumber(place.receive_hope_max) }}日 エンタープライズ:{{ $filters.formatNumber(place.receive_hope_max_company) }}日
                                    <span class="text-red">※0は無効と同等</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">受取営業時間制御</td>
                                <td colspan="3">
                                    <span v-if="place.receive_place_all_time_yn == 'N' && place.receive_place_start_time != ''">
                                        開始時間：{{ place.receive_place_start_time }}～終了時間：{{ place.receive_place_end_time }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">返却営業時間制御</td>
                                <td colspan="3">
                                    <span v-if="place.return_place_all_time_yn == 'N' && place.return_place_start_time != ''">
                                        開始時間：{{ place.return_place_start_time }}～終了時間：{{ place.return_place_end_time }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">出荷場所</td>
                                <td class="">{{ place.location_master?.name }}</td>
                                <td class="bg-gray">不備チェック</td>
                                <td class=""><CommonMst :mstNm="`loss_check`" v-model="place.loss_check"></CommonMst></td>
                            </tr>
                            <tr>
                                <td class="bg-gray" rowspan="3">サイト制御</td>
                                <td class="bg-gray">利用サイト-受取</td>
                                <td colspan="3">{{ place.order_form_name ? (place.order_form_name).join(', ') : '' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-gray">利用サイト-返却</td>
                                <td colspan="3">{{ place.order_form_return_name ? (place.order_form_return_name).join(', ') : '' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-gray">フォーム遷移</td>
                                <td colspan="3"><CommonMst :mstNm="`valid_yn`" v-model="place.site_jump"></CommonMst></td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">VMBS利用</td>
                                <td class=""><CommonMst :mstNm="`usage_yn`" v-model="place.vmbs_yn"></CommonMst></td>
                                <td class="bg-gray">受取時説明対応</td>
                                <td class=""><CommonMst :mstNm="`existence_yn`" v-model="place.explain_yn"></CommonMst></td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">備考</td>
                                <td colspan="3">{{ place.remarks }}</td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">受取時間帯</td>
                                <td class=""><CommonMst :mstNm="`place_receive_return_time`" v-model="place.receive_time"></CommonMst></td>
                                <td class="bg-gray">返却時間帯	</td>
                                <td class=""><CommonMst :mstNm="`place_receive_return_time`" v-model="place.return_time"></CommonMst></td>
                            </tr>
                            <tr>
                                <td class="bg-gray" colspan="2">登録日付</td>
                                <td class="">{{ utils.formatDateTime(place.reg_dt) }}</td>
                                <td class="bg-gray">更新日時</td>
                                <td class="">{{ utils.formatDateTime(place.upd_dt) }}</td>
                            </tr>                                                
                        </tbody>
                    </table>
                    <div class="text-center group-btn">
                        <router-link :to="{name: 'place_list'}" class="btn btn-gray" title="一覧へ">一覧へ</router-link>
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
import { useRoute, useRouter } from "vue-router";
import { useStore } from 'vuex';
import { computed, ref } from "vue";
import utils from '@/service/utils';
export default {
    components: { CommonMst },
    setup(){
        const router = useRouter();
        const route = useRoute();
        const place = ref({});
        const store = useStore();
        const commonMst = computed(() => store.state.common);
        const loadCommonMst = () => {
            let mst_id = ['place_local_area', 'place_terminal_name', 'place_counter_type', 'status_nq',
                        'location_io', 'place_type', 'site_display_yn', 'possible_narita_yn', 'loss_check', 
                        'order_form', 'valid_yn', 'usage_yn', 'existence_yn', 'place_receive_return_time'];
            store.dispatch("common/getCommonMst", mst_id);
        }
        const getPlace  = (id) => {
            ServiceAPI.axiosCall("place_detail", {id: id})
                .then((res) => {
                    if(!res.error){
                        place.value = res.response;
                    }else{
                        router.push({ name: 'page_404'});
                    }
            })
            .catch((err) => {
                console.log(err);
            });
        }
        getPlace(route.params.id);
        loadCommonMst();
        return {place, commonMst, utils};
    }
}
</script>

<style>

</style>