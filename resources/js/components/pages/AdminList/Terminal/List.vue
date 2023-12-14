<template>
    <div id="tab-5" class="tabcontent" style="display: block;">
        <div class="page-title-top">
            <p>端末基本情報一覧</p>
        </div>
        <div class="block-content-wrapper">
            <div class="block-content">
                <div class="block-group-search">
                    <div class="search-row">
                        <div class="field-search field-2w field-mobile-1w">
                            <label for="001" class="label-control">商品コード</label>
                            <div class="field-search-input">
                                <input type="text" name="code_name" id="001" class="form-control" v-model="search.code_name">
                            </div>
                        </div>
                        <div class="field-search field-2w field-mobile-1w">
                            <label for="002" class="label-control">メーカー</label>
                            <div class="field-search-input">
                                <input type="text" name="maker_name" id="002" class="form-control" v-model="search.maker_name">
                            </div>
                        </div>
                        <div class="field-search field-2w">
                            <label for="003" class="label-control">商品名</label>
                            <div class="field-search-input">
                                <input type="text" name="name" id="003" class="form-control" v-model="search.name">
                            </div>
                        </div>
                    </div>
                    <div class="search-row">
                        <div class="field-search field-2w field-mobile-1w">
                            <label for="006" class="label-control">対応国</label>
                            <div class="field-search-input">
                                <select id="007" class="form-control" name="search_support_country_id" v-model="search.search_support_country_id">
                                    <option value="">選択</option>
                                    <option v-for="item in support_country_list" :key="item.id"  :value="item.id">{{item.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="field-search field-2w field-mobile-1w">
                            <label for="007" class="label-control">登録担当者</label>
                            <div class="field-search-input">
                                <select id="007" class="form-control" name="reg_admin_id" v-model="search.reg_admin_id">
                                    <option value="">選択</option>
                                    <option v-for="item in admin_list" :key="item.id"  :value="item.id">{{item.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="field-search">
                            <label for="008" class="label-control">登録日</label>
                            <div class="field-search-input">
                                <DatePickerBase v-model="search.search_reg_dt"/>
                            </div>
                        </div>
                        <div class="field-search">
                            <div class="d-flex-center-y ml-20px">
                                <label class="d-flex-center-y">
                                    <input type="radio" name="search_reg_dt_cond_compare" value="1" v-model="search.search_reg_dt_cond_compare">
                                    <span class="">以上</span>
                                </label>
                                <label class="d-flex-center-y ml-20px">
                                    <input type="radio" name="search_reg_dt_cond_compare" value="2" v-model="search.search_reg_dt_cond_compare">
                                    <span class="">以下</span>
                                </label>
                            </div>
                        </div>
                        <div class="field-search one-field-mobile-right">
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
                                <col style="width: 500px;">
                                <col style="width: 100px;">
                                <col style="width: 100px;">
                                <col style="width: 500px;">
                                <col style="width: 110px;">
                                <col style="width: 130px;">
                                <col style="width: 80px;">
                            </colgroup>
                            <thead>
                                <tr class="bg-gray text-center">
                                    <td>商品コード</td>
                                    <td>メーカー</td>
                                    <td>商品名</td>
                                    <td>対応国</td>
                                    <td>登録担当</td>
                                    <td>登録日時</td>
                                    <td>詳細</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr :class="{'bg-gray' : key % 2 != 0} " v-for="(value, key) in search_result.data" :key="value.id">
                                    <td>{{ value.code_name }}</td>
                                    <td>{{ value.maker_name }}</td>
                                    <td>{{ value.name }}</td>
                                    <td>
                                        {{ getSupportCountryListName(value.id).join(', ') }}
                                    </td>
                                    <td>{{ value.registrant_admin?.name }}</td>
                                    <td class="text-center">{{ utils.formatDateTime(value.reg_dt) }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'terminal_detail', params:{id: value.id}}" class="btn btn-primary" title="詳細">詳細</router-link>
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
import DatePickerBase from "@/components/plugins/DatePickerBase.vue";
import { computed, ref } from "vue";
import { useStore } from 'vuex'
import ServiceAPI from "@/service/api";
import utils from '@/service/utils';


export default {
    components: { PaginationBase, DatePickerBase  },
    setup(){
        let total_items = ref(0) 
        let current_page = ref(1);
        let items_per_page = ref(15);
        const search_result = ref({});
        let default_search = {
            order_by: '-sort_no',
            per_page: items_per_page.value,
            page: 1,
            screen_nm: "terminal_list",
            code_name: '',
            maker_name: '',
            name: '',
            search_support_country_id: '',
            reg_admin_id: '',
            search_reg_dt: null,
            search_reg_dt_cond_compare: 1 // option value(1: >=, 2: <=)
        };
        const list_sort = [
            { value :'+sort_no', text: '表示順昇順'},
            { value :'-sort_no', text: '表示順逆順'},
            { value :'+reg_dt', text: '登録日古順'},
            { value :'-reg_dt', text: '登録日新順'},
            { value :'+name', text: '商品名順'},
        ];
        const support_country_list = ref([]);
        const admin_list = ref([]);
        const search = ref(Object.assign({}, default_search));
        const store = useStore();

        const searchCondition = ()=>{
          ServiceAPI.axiosCall("search_condition", {screen_nm: 'terminal_list'})
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
                      terminalSearch();
                }
            })
            .catch((err) => {
                console.log(err);
            });
        }

        const terminalSearch = () =>{
            search.value.page = current_page.value;
            search.value.per_page = items_per_page.value;
            ServiceAPI.axiosCall("terminal_list_search", search.value)
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

        const supportCountryList = () => {
			ServiceAPI.axiosCall("support_country_data", {})
				.then((res) => {
					if (!res.error) {
						support_country_list.value = res.response;
					}
				})
				.catch((err) => {
					console.log(err);
				});
		};
        const adminList = () => {
			ServiceAPI.axiosCall("admin_data", {})
				.then((res) => {
					if (!res.error) {
						admin_list.value = res.response;
					}
				})
				.catch((err) => {
					console.log(err);
				});
		};

        const getSupportCountryListName = (terminal_id ) => {
            let array_support_country = [];
            let terminal = _.find(search_result.value.data, {id: terminal_id});
            if(terminal.products){
                (terminal.products).forEach(value => {
                    if(value.support_country != null && !array_support_country.includes(value.support_country.name)){
                        array_support_country.push(value.support_country.name);
                    }
                })
            }
            return array_support_country;
        }

        const clearSearch = ()=>{
          current_page.value = default_search.page;
          search.value = Object.assign({}, default_search);
          search.value.btn = "clear";
          terminalSearch();
        }
        const handleSearch = ()=>{
          search.value.btn = "search";
          current_page.value = default_search.page;
          terminalSearch();
        }
        const onPageChange = ()=>{
          search.value.btn = "";
          terminalSearch();
        }
        supportCountryList();
        adminList();
        searchCondition();
        

        return {
            list_sort, utils, support_country_list, admin_list, 
            search, items_per_page, current_page, search_result, total_items,
            handleSearch, clearSearch, onPageChange, getSupportCountryListName
        };

    }
  
};
</script>

<style>
</style>