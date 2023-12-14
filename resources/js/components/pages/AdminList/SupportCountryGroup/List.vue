<template>
    <div id="tab-3" class="tabcontent" style="display: block;">
        <div class="page-title-top">
            <p>周遊国一覧</p>
        </div>
        <div class="block-content-wrapper">
            <div class="block-content">
                <div class="block-group-search">
                    <div class="search-row">
                        <div class="field-search">
                            <label for="001" class="label-control">追加グループ</label>
                            <div class="field-search-input">
                                <select id="f002" class="form-control" name="add_group_key" v-model="search.add_group_key">
                                <option value="">選択</option>
                                <option v-for="(value, key) in commonMst.add_group" :key="key"  :value="value.code_value">{{ value.disp_value }}</option>
                            </select>
                            </div>
                        </div>
                        <div class="field-search">
                            <label for="002" class="label-control">状態</label>
                            <div class="field-search-input">
                                <select id="f008" class="form-control" name="status" v-model="search.status">
                            <option value="">選択</option>
                            <option v-for="(value, key) in commonMst.status_nq" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                          </select>
                            </div>
                        </div>
                        <div class="field-search">
                            <div class="field-search-input ml-20px">
                                <a href="" class="btn btn-black"  @click.prevent="handleSearch">
                                    <i class="fas fa-search"></i>&nbsp;&nbsp;&nbsp;
                                    <span>検索</span>
                                </a>
                                <a href="" class="btn btn-gray"  @click.prevent="clearSearch">クリア</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-search-result">
                    <div class="search-result-top">
                        <div class="search-result-title">
                            該当：{{ $filters.formatNumber(search_result.total) }}件
                        </div>
                        <div class="d-flex-center-y">
                            <select id="001xx" class="form-control flex-1" v-model="search.order_by" @change="handleSearch">
                                <option v-for="item in list_sort" :key="item.value"  :value="item.value">{{item.text}}</option>
                            </select>
                            <label for="002xx" class="label-control">表示数</label>
                            <select id="002xx" class="form-control flex-1" v-model="items_per_page" @change="handleSearch">
                                <option v-for="item in utils.getListItemPerPage()" :key="item"  :value="item">{{item}}件</option>
                            </select>
                        </div>
                    </div>
                    <div class="search-result-table">
                        <table class="table table-bordered table-fixed">
                            <colgroup>
                                <col style="width: 60px;">
                                <col style="width: 170px;">
                                <col style="width: 120px;">
                                <col style="width: 60px;">
                                <col style="width: 60px;">
                                <col style="width: 800px;">
                                <col style="width: 120px;">
                                <col style="width: 80px;">
                            </colgroup>
                            <thead>
                                <tr class="bg-gray text-center">
                                    <td>ID</td>
                                    <td>名前</td>
                                    <td>追加グループ</td>
                                    <td>優先度</td>
                                    <td>状態</td>
                                    <td>対応国/対応SIM</td>
                                    <td>登録日時</td>
                                    <td>詳細</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="row in search_result.data" :key="row.id">
                                    <td class="text-center">{{ row.id }}</td>
                                    <td class="">{{ row.name }}</td>
                                    <td class="text-center"><CommonMst :mstNm="`add_group`" v-model="row.add_group_key"></CommonMst></td>
                                    <td class="text-right">{{ row.add_group_priority }}</td>
                                    <td class="text-center"><CommonMst :mstNm="`status_nq`" v-model="row.status"></CommonMst></td>
                                    <td class="" v-if="row.world_yn === 'N'">
                                        <table class="table table-fixed table-nested tb-cell-ellipsis"  v-if="(row.support_countries).length > 0">
                                            <colgroup>
                                                <col style="width: 25%;">
                                                <col style="width: 25%;">
                                                <col style="width: 25%;">
                                                <col style="width: 25%;">
                                            </colgroup>
                                            <tbody>
                                                <!-- Display 4(count_item_per_row) items per rows -->
                                                <tr v-for="n in Math.ceil((row.support_countries).length / count_item_per_row)">
                                                    <td v-for="(value, key) in row.support_countries" :key="key" v-show="key >= (n - 1)*count_item_per_row && key <= n * (count_item_per_row) - 1">
                                                        {{ value.name }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p>
                                            <span class="text-green">合計</span>
                                            <span class="text-red">{{ (row.support_countries).length }}</span>
                                            <span class="text-green">国</span>
                                        </p>
                                    </td>
                                    <td v-if="row.world_yn !== 'N'">{{ row.world_sim_condition_name.join(', ') }}</td>
                                    <td class="text-center">{{ utils.formatDateTime(row.reg_dt) }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'support_country_group_detail', params:{id: row.id}}" class="btn btn-primary" title="詳細">詳細</router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="search-pagination">
                        <p class="search-result-title">
                        <span>{{$filters.formatNumber(search_result.from)}}〜{{$filters.formatNumber(search_result.to)}}</span>
                        &nbsp;/&nbsp;
                        <span>{{$filters.formatNumber(search_result.total)}}件</span>
                      </p>
                        <div class="pagi">
                            <PaginationBase
                            :totalItems="total_items"
                            :itemsPerPage="items_per_page"
                            @onPageChange="onPageChange"
                            v-model="current_page"
                            paginationContainerClass=""
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PaginationBase from "@/components/plugins/PaginationBase.vue";
import CommonMst from "@/components/partials/CommonMst.vue";
import { computed, ref } from "vue";
import { useStore } from 'vuex'
import ServiceAPI from "@/service/api";
import utils from '@/service/utils';


export default {
    components: { PaginationBase, CommonMst },
    setup(){
        let total_items = ref(0) 
        let current_page = ref(1);
        let items_per_page = ref(15);
        let count_item_per_row = ref(4);
        const search_result = ref({});
        let default_search = {
            order_by: '-reg_dt',
            per_page: items_per_page.value,
            page: 1,
            add_group_key:"",
            status:"",
            screen_nm: "support_country_group_list",
        };
        const list_sort = [
            { value :'+reg_dt', text: '登録日古順'},
            { value :'-reg_dt', text: '登録日新順'},
            { value :'+name', text: '名前順'}
        ]
        const search = ref(Object.assign({}, default_search));
        const store = useStore();
        const commonMst = computed(() => store.state.common);
        const loadCommonMst = () => {
            let mst_id = ['add_group', 'status_nq'];
            store.dispatch("common/getCommonMst", mst_id);
        }

        const searchCondition = ()=>{
          ServiceAPI.axiosCall("search_condition", {screen_nm: 'support_country_group_list'})
                .then((res) => {
                    if(!res.error){
                      if(Object.keys(res.response).length){
                        search.value =  Object.assign(search.value, res.response) ;
                        if(res.response.page){
                          current_page.value = res.response.page;
                        }
                        if(res.response.per_page){
                          items_per_page.value = res.response.per_page;
                        }
                      }
                      supportCountryGroupSearch();
                }
            })
            .catch((err) => {
                console.log(err);
            });
        }

        const supportCountryGroupSearch = ()=>{
            search.value.page = current_page.value;
            search.value.per_page = items_per_page.value;
            ServiceAPI.axiosCall("support_country_group_search", search.value)
                .then((res) => {
                    if(!res.error){
                        search_result.value = res.response;
                        total_items.value = res.response.total;
                    }
            })
            .catch((err) => {
                console.log(err);
            });
        }
        const clearSearch = ()=>{
          current_page.value = default_search.page;
          search.value = Object.assign({}, default_search);
          search.value.btn = "clear";
          supportCountryGroupSearch();
        }
        const handleSearch = ()=>{
          search.value.btn = "search";
          current_page.value = default_search.page;
          supportCountryGroupSearch();
        }
        const onPageChange = ()=>{
          search.value.btn = "";
          supportCountryGroupSearch();
        }

        searchCondition();
        loadCommonMst();
        

        return {
            list_sort, commonMst, utils, count_item_per_row,
            search, items_per_page, current_page, search_result, total_items,
            handleSearch, clearSearch, onPageChange
        };

    }
  
};
</script>

<style>
</style>