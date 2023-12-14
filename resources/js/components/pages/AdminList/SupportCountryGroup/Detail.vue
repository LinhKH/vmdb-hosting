<template>
    <div id="tab-3" class="tabcontent" style="display: block;">
        <div class="page-title-top">
            <p>周遊国詳細</p>
            <!-- <div>
                <a href="" class="btn btn-primary">担当者詳細</a>
                <a href="" class="btn btn-primary">メールフォーム</a>
            </div> -->
        </div>
        <div class="block-content-wrapper">
            <div class="block-content">
                <div class="block-search-result w-per-60 m-auto">
                    <div class="edit-page-content">
                        <table class="table table-bordered">
                            <colgroup>
                                <col style="width: 170px;">
                                <col style="">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <td class="bg-gray">ID</td>
                                    <td class="bg-gray">{{ supportCountryGroup.id }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">名前</td>
                                    <td>{{ supportCountryGroup.name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">世界周遊</td>
                                    <td class="bg-gray">
                                        <CommonMst :mstNm="`status_yn`" v-model="supportCountryGroup.world_yn"></CommonMst>
                                    </td>
                                </tr>
                                <tr class="tb-title-row">
                                    <td colspan="2">対応国</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">
                                        対応国名
                                    </td>
                                    <td class="bg-gray">
                                        <span v-for="(value, key) in supportCountryGroup.support_countries" :key="key" v-if="supportCountryGroup.world_yn === 'N'">
                                            {{ key == 0 ? value.name : ', ' + value.name }}
                                        </span>
                                        <span v-if="supportCountryGroup.world_yn !== 'N' && supportCountryGroup.world_sim_condition_name">{{ supportCountryGroup.world_sim_condition_name.join(', ') }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">備考</td>
                                    <td>{{ supportCountryGroup.info }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">登録日付</td>
                                    <td class="bg-gray">
                                        {{ utils.formatDateTime(supportCountryGroup.reg_dt) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">更新日付</td>
                                    <td>{{ utils.formatDateTime(supportCountryGroup.upd_dt) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center group-btn">
                            <router-link :to="{name: 'support_country_group_list'}" class="btn btn-gray" title="一覧へ">一覧へ</router-link>
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
        const supportCountryGroup = ref({});
        const store = useStore();
        const commonMst = computed(() => store.state.common);
        const loadCommonMst = () => {
            let mst_id = ['status_yn'];
            store.dispatch("common/getCommonMst", mst_id);
        }
        const getSupportCountryGroup  = (id) => {
            ServiceAPI.axiosCall("support_country_group_detail", {id: id})
                .then((res) => {
                    if(!res.error){
                        supportCountryGroup.value = res.response;
                    }else{
                        router.push({ name: 'page_404'});
                    }
            })
            .catch((err) => {
                console.log(err);
            });
        }
        getSupportCountryGroup(route.params.id);
        loadCommonMst();
        return {supportCountryGroup, commonMst, utils};
    }
}
</script>

<style>

</style>