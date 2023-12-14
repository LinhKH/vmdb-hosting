<template>
    <div id="tab-5" class="tabcontent" style="display: block;">
        <div class="page-title-top">
            <p>端末基本情報詳細</p>
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
                                    <td>{{ terminal.id }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">商品コード</td>
                                    <td>{{ terminal.code_name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">メーカー</td>
                                    <td>{{ terminal.maker_name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">商品名</td>
                                    <td>{{ terminal.name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">端末区分</td>
                                    <td><CommonMst :mstNm="`terminal_section`" v-model="terminal.section"></CommonMst></td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">備考</td>
                                    <td>{{ terminal.remarks }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">対応国</td>
                                    <td>
                                        {{ supportCountryListName.join(', ') }}
                                    </td>
                                </tr>
                                <tr class="tb-title-row">
                                    <td colspan="2">担当者情報</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">登録担当者</td>
                                    <td>{{ terminal.registrant_admin?.name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">登録日付</td>
                                    <td>{{ utils.formatDateTime(terminal.reg_dt) }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">更新担当者</td>
                                    <td>{{ terminal.updater_admin?.name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray">更新日付</td>
                                    <td>{{ utils.formatDateTime(terminal.upd_dt) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center group-btn">
                            <router-link :to="{name: 'terminal_list'}" class="btn btn-gray" title="一覧へ">一覧へ</router-link>
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
        const terminal = ref({});
        const supportCountryListName = ref([]);
        const store = useStore();
        const commonMst = computed(() => store.state.common);
        const loadCommonMst = () => {
            let mst_id = ['terminal_section'];
            store.dispatch("common/getCommonMst", mst_id);
        }
        const getTerminal  = (id) => {
            ServiceAPI.axiosCall("terminal_detail", {id: id})
                .then((res) => {
                    if(!res.error){
                        terminal.value = res.response;
                        getSupportCountryListName();
                    }else{
                        router.push({ name: 'page_404'});
                    }
            })
            .catch((err) => {
                console.log(err);
            });
        }
        const getSupportCountryListName = () => {
            let array_support_country = [];
            if(terminal.value.products){
                (terminal.value.products).forEach(value => {
                    if(value.support_country != null && !array_support_country.includes(value.support_country.name)){
                        array_support_country.push(value.support_country.name);
                    }
                })
            }
            supportCountryListName.value = array_support_country;
        }
        getTerminal(route.params.id);
        loadCommonMst();
        return {terminal, commonMst, utils, supportCountryListName};
    }
}
</script>

<style>

</style>