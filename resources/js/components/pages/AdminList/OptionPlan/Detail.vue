<template>
<div id="tab-8" class="tabcontent" style="display: block;">
    <div class="page-title-top">
        <p>オプションプラン詳細</p>
    </div>
    <div class="block-content-wrapper">
        <div class="block-content">
            <div class="block-search-result w-per-60 m-auto">
                <div class="edit-page-content">
                    <table class="table table-bordered">
                        <colgroup>
                            <col style="width: 120px;">
                            <col style="width: 250px;">
                            <col style="width: 120px;">
                            <col style="width: 300px;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td class="bg-gray">ID</td>
                                <td class="" colspan="3">{{ optionPlan.id }}</td>
                            </tr>
                            <tr>
                                <td class="bg-gray">名前</td>
                                <td class="">{{ optionPlan.display_name }}</td>
                                <td class="bg-gray">サイトコード</td>
                                <td>
                                    {{ optionPlan.option_plan_code }} <br>
                                    <span class="text-red">※プランを表す文字列。サイト側でシステム利用されます。</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-gray">定価</td>
                                <td><span class="text-red">{{ $filters.formatNumber(optionPlan.proper) }}</span> 円</td>
                                <td class="bg-gray">料金</td>
                                <td><span class="text-red">{{ $filters.formatNumber(optionPlan.money) }}</span> 円</td>
                            </tr>
                            <tr class="tb-title-row">
                                <td class="" colspan="4">サイト側設定</td>
                            </tr>
                            <tr>
                                <td class="bg-gray">表示名</td>
                                <td colspan="3">{{ optionPlan.name }}</td>
                            </tr>
                            <tr>
                                <td class="bg-gray">サイト表示制御</td>
                                <td colspan="3">{{ optionPlan.option_site_switch_name ? (optionPlan.option_site_switch_name).join(', ') : '' }}</td>
                            </tr>
                            <tr class="tb-title-row">
                                <td class="" colspan="4">オプション</td>
                            </tr>
                            <tr>
                                <td class="bg-gray">名前</td>
                                <td colspan="3">
                                    <span v-for="(valueOption, keyOption) in  optionPlan.options" :key="keyOption">
                                        {{ keyOption != 0 ? ', ' + valueOption.name : valueOption.name }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-gray">備考</td>
                                <td colspan="3">{{ optionPlan.remarks }}</td>
                            </tr>
                            <tr>
                                <td class="bg-gray">登録日時</td>
                                <td class="">{{ utils.formatDateTime(optionPlan.reg_dt) }}</td>
                                <td class="bg-gray">更新日時</td>
                                <td class="">{{ utils.formatDateTime(optionPlan.upd_dt) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center group-btn">
                        <router-link :to="{name: 'option_plan_list'}" class="btn btn-gray" title="一覧へ">一覧へ</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import ServiceAPI from "@/service/api";
import { useRoute, useRouter } from "vue-router";
import { ref } from "vue";
import utils from '@/service/utils';
export default {
    components: { },
    setup(){
        const router = useRouter();
        const route = useRoute();
        const optionPlan = ref({});
        const getOptionPlan  = (id) => {
            ServiceAPI.axiosCall("option_plan_detail", {id: id})
                .then((res) => {
                    if(!res.error){
                        optionPlan.value = res.response;
                    }else{
                        router.push({ name: 'page_404'});
                    }
            })
            .catch((err) => {
                console.log(err);
            });
        }
        getOptionPlan(route.params.id);
        return {optionPlan, utils};
    }
}
</script>

<style>

</style>