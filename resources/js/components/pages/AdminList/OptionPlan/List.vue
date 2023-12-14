<template>
    <div id="tab-8" class="tabcontent" style="display: block;">
        <div class="page-title-top">
            <p>オプションプラン一覧</p>
        </div>
        <div class="block-content-wrapper">
            <div class="block-content">
                <div class="block-group-search">
                    <div class="search-row">
                        <div class="field-search">
                            <label for="001" class="label-control">ID</label>
                            <div class="field-search-input">
                                <input type="number" name="" id="001" class="form-control" v-model="search.id">
                            </div>
                        </div>
                        <div class="field-search">
                            <label for="002" class="label-control">名前</label>
                            <div class="field-search-input">
                                <input type="text" name="" id="002" class="form-control" v-model="search.display_name">
                            </div>
                        </div>
                        <div class="field-search">
                            <div class="field-search-input ml-20px ">
                                <a href="" class="btn btn-black" @click.prevent="handleSearch">
                                    <i class="fas fa-search"></i>&nbsp;&nbsp;&nbsp;
                                    <span>検索</span>
                                </a>
                                <a href="" class="btn btn-gray" @click.prevent="clearSearch">クリア</a>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-red fs-10px mb-10px">※早割料金は申込日が3日前の場合に適用されます</p>
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
                                <col style="width: 80px;">
                                <col style="width: 380px;">
                                <col style="width: 150px;">
                                <col style="width: 380px;">
                                <col style="width: 130px;">
                                <col style="width: 130px;">
                                <col style="width: 80px;">
                            </colgroup>
                            <thead>
                                <tr class="bg-gray text-center">
                                    <td>ID</td>
                                    <td>名前</td>
                                    <td>料金</td>
                                    <td>オプション</td>
                                    <td>備考</td>
                                    <td>登録日時</td>
                                    <td>詳細</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr :class="{'bg-gray' : key % 2 != 0} " v-for="(value, key) in search_result.data" :key="value.id">
                                    <td class="text-right">{{ value.id }}</td>
                                    <td>{{ value.display_name }}</td>
                                    <td class="text-right">
                                        <span class="text-red">{{ $filters.formatNumber(value.money) }}</span> 円
                                    </td>
                                    <td>
                                        <div v-for="(valueOption, keyOption) in  value.options" :key="keyOption">
                                            {{ valueOption.name }}
                                        </div>
                                    </td>
                                    <td>{{ value.remarks }}</td>
                                    <td class="text-center">{{ utils.formatDateTime(value.reg_dt) }}</td>
                                    <td class="text-center"><router-link :to="{name: 'option_plan_detail', params:{id: value.id}}" class="btn btn-primary" title="詳細">詳細</router-link></td>
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
import { ref } from "vue";
import ServiceAPI from "@/service/api";
import utils from '@/service/utils';

export default {
    components: { PaginationBase },
    setup(){
        let total_items = ref(0) 
        let current_page = ref(1);
        let items_per_page = ref(15);
        const search_result = ref({});
        let default_search = {
            order_by: '-reg_dt',
            per_page: items_per_page.value,
            page: 1,
            screen_nm: "option_plan_list",
            id: '',
            display_name: ''
        };
        const list_sort = [
            { value :'+reg_dt', text: '登録日古順'},
            { value :'-reg_dt', text: '登録日新順'},
            { value :'+order_no', text: '表示順昇順'}
        ];
        const search = ref(Object.assign({}, default_search));

        const searchCondition = ()=>{
            ServiceAPI.axiosCall("search_condition", {screen_nm: default_search.screen_nm})
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
                        optionPlanSearch();
                }
            })
            .catch((err) => {
                console.log(err);
            });
        }

        const optionPlanSearch = () =>{
            search.value.page = current_page.value;
            search.value.per_page = items_per_page.value;
            ServiceAPI.axiosCall("option_plan_list_search", search.value)
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
            optionPlanSearch();
        }
        const handleSearch = ()=>{
            search.value.btn = "search";
            current_page.value = default_search.page;
            optionPlanSearch();
        }
        const onPageChange = ()=>{
            search.value.btn = "";
            optionPlanSearch();
        }
        searchCondition();

        return {
            list_sort, utils,
            search, items_per_page, current_page, search_result, total_items,
            handleSearch, clearSearch, onPageChange
        };
    }
};
</script>

<style>
</style>