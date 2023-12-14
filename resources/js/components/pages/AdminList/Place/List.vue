<template>
    <div id="tab-9" class="tabcontent" style="display: block;">
        <div class="page-title-top">
            <p>場所一覧</p>
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
                            <label for="002" class="label-control">状態</label>
                            <div class="field-search-input">
                                <select name="" id="002" class="form-control" v-model="search.status">
                                    <option value="">選択</option>
                                    <option v-for="(value, key) in commonMst.status_nq" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="field-search">
                            <label for="003" class="label-control">在庫連動</label>
                            <div class="field-search-input">
                                <select name="" id="003" class="form-control" v-model="search.stock_ctrl_yn">
                                    <option value="">選択</option>
                                    <option v-for="(value, key) in commonMst.usage_yn" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="field-search">
                            <label for="004" class="label-control">出荷場所</label>
                            <div class="field-search-input">
                                <select name="" id="004" class="form-control" v-model="search.center_id">
                                    <option value="">選択</option>
                                    <option v-for="(value, key) in location_master_list" :key="key" :value="value.id">{{ value.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="field-search">
                            <label for="005" class="label-control">場所マスタ</label>
                            <div class="field-search-input">
                                <select name="" id="005" class="form-control" v-model="search.master_id">
                                    <option value="">選択</option>
                                    <option v-for="(value, key) in place_master_list" :key="key" :value="value.place_master_id">{{ value.place_master_name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="field-search">
                            <label for="006" class="label-control">場所名</label>
                            <div class="field-search-input">
                                <input type="text" name="" id="006" class="form-control" v-model="search.name">
                            </div>
                        </div>
                        <div class="field-search">
                            <label for="007" class="label-control">サイト表示</label>
                            <div class="field-search-input">
                                <select name="" id="007" class="form-control" v-model="search.site_status">
                                    <option value="">選択</option>
                                    <option v-for="(value, key) in commonMst.site_display_yn" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="field-search one-field-right mt-5px">
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
                                <col style="width: 70px;">
                                <col style="width: 90px;">
                                <col style="width: 170px;">
                                <col style="width: 100px;">
                                <col style="width: 70px;">
                                <col style="width: 110px;">
                                <col style="width: 90px;">
                                <col style="width: 90px;">
                                <col style="width: 70px;">
                                <col style="width: 70px;">
                                <col style="width: 105px;">
                                <col style="width: 100px;">
                                <col style="width: 90px;">
                                <col style="width: 90px;">
                                <col style="width: 70px;">
                                <col style="width: 70px;">
                                <col style="width: 70px;">
                                <col style="width: 130px;">
                                <col style="width: 130px;">
                                <col style="width: 80px;">
                            </colgroup>
                            <thead>
                                <tr class="bg-gray text-center">
                                    <td rowspan="2">ID</td>
                                    <td rowspan="2">場所マスタ</td>
                                    <td rowspan="2">場所名</td>
                                    <td rowspan="2">出荷場所</td>
                                    <td rowspan="2">状態</td>
                                    <td rowspan="2">受取手数料無料</td>
                                    <td rowspan="2">受取料金</td>
                                    <td rowspan="2">返却料金</td>
                                    <td rowspan="2">拠点</td>
                                    <td rowspan="2">タイプ</td>
                                    <td rowspan="2">申込期限</td>
                                    <td rowspan="2">在庫連動</td>
                                    <td rowspan="2">バッファ日数</td>
                                    <td rowspan="2">サイト表示</td>
                                    <td colspan="3">利用サイト</td>
                                    <td rowspan="2">登録日時</td>
                                    <td rowspan="2">登録日時</td>
                                    <td rowspan="2">詳細</td>
                                </tr>
                                <tr class="bg-gray text-center">
                                    <td>受取</td>
                                    <td>返却</td>
                                    <td>無効</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr :class="{'bg-gray' : key % 2 != 0} " v-for="(value, key) in search_result.data" :key="value.id">
                                    <td class="text-right">{{ value.id }}</td>
                                    <td>{{ value.place_master?.place_master_name }}</td>
                                    <td>{{ value.name }}</td>
                                    <td>{{ value.id == 16 && value.location_master != null ? value.location_master?.name + 'または、堺SRC' : value.location_master?.name }}</td>
                                    <td class="text-center"><CommonMst :mstNm="`status_nq`" v-model="value.status"></CommonMst></td>
                                    <td class="text-center"><CommonMst :mstNm="`usage_yn`" v-model="value.free_status"></CommonMst></td>
                                    <td class="text-right"><span class="">{{ $filters.formatNumber(value.add_receive_money) }}</span> 円</td>
                                    <td class="text-right"><span class="">{{ $filters.formatNumber(value.add_return_money) }}</span> 円</td>
                                    <td class="text-center"><CommonMst :mstNm="`location_io`" v-model="value.location"></CommonMst></td>
                                    <td class="text-center"><CommonMst :mstNm="`place_type`" v-model="value.type"></CommonMst></td>
                                    <td>
                                        <span v-if="value.limit_status == 'Y'">
                                            {{ value.limit_day != '' ? value.limit_day +'日前' : '0日前' }}
                                            {{ value.limit_time != '' ? value.limit_time +'時' : '' }}
                                            迄
                                        </span>
                                    </td>
                                    <td class="text-center"><CommonMst :mstNm="`usage_yn`" v-model="value.stock_ctrl_yn"></CommonMst></td>
                                    <td>{{ value.stock_ctrl_yn != 'N' ? $filters.formatNumber(value.stock_ctrl_buffer_day) + '日' : '' }}</td>
                                    <td class="text-center"><CommonMst :mstNm="`site_display_yn`" v-model="value.site_status"></CommonMst></td>
                                    <td class="text-center">{{ value.use_form_ids }}</td>
                                    <td class="text-center">{{ value.use_form_return_ids }}</td>
                                    <td class="text-center"><CommonMst :mstNm="`valid_yn`" v-model="value.site_jump"></CommonMst></td>
                                    <td class="text-center">{{ utils.formatDateTime(value.reg_dt) }}</td>
                                    <td class="text-center">{{ utils.formatDateTime(value.upd_dt) }}</td>
                                    <td class="text-center"><router-link :to="{name: 'place_detail', params:{id: value.id}}" class="btn btn-primary" title="詳細">詳細</router-link></td>
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
        const search_result = ref({});
        let default_search = {
            order_by: '-order_no',
            per_page: items_per_page.value,
            page: 1,
            screen_nm: "place_list",
            id: '',
            status: '',
            stock_ctrl_yn: '',
            center_id: '',
            master_id: '',
            name: '',
            site_status: ''
        };
        const list_sort = [
            { value :'+order_no', text: '表示順昇順'},
            { value :'-order_no', text: '表示順逆順'},
            { value :'+reg_dt', text: '登録日古順'},
            { value :'-reg_dt', text: '登録日新順'}
        ];
        const support_country_list = ref([]);
        const location_master_list = ref([]);
        const place_master_list = ref([]);
        const search = ref(Object.assign({}, default_search));
        const store = useStore();
        const commonMst = computed(() => store.state.common);
        const loadCommonMst = () => {
            let mst_id = ['status_nq', 'usage_yn', 'site_display_yn', 'location_io', 'place_type', 'valid_yn'];
            store.dispatch("common/getCommonMst", mst_id);
        }

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
                        placeSearch();
                }
            })
            .catch((err) => {
                console.log(err);
            });
        }

        const placeSearch = () =>{
            search.value.page = current_page.value;
            search.value.per_page = items_per_page.value;
            ServiceAPI.axiosCall("place_list_search", search.value)
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

        const locationMasterList = () => {
			ServiceAPI.axiosCall("location_master_data", {})
				.then((res) => {
					if (!res.error) {
						location_master_list.value = res.response;
					}
				})
				.catch((err) => {
					console.log(err);
				});
		};

        const placeMasterList = () => {
			ServiceAPI.axiosCall("place_master_data", {})
				.then((res) => {
					if (!res.error) {
						place_master_list.value = res.response;
					}
				})
				.catch((err) => {
					console.log(err);
				});
		};

        const clearSearch = ()=>{
            current_page.value = default_search.page;
            search.value = Object.assign({}, default_search);
            search.value.btn = "clear";
            placeSearch();
        }
        const handleSearch = ()=>{
            search.value.btn = "search";
            current_page.value = default_search.page;
            placeSearch();
        }
        const onPageChange = ()=>{
            search.value.btn = "";
            placeSearch();
        }
        
        supportCountryList();                 
        loadCommonMst();
        locationMasterList();
        placeMasterList();
        searchCondition();

        return {
            list_sort, utils, support_country_list, commonMst, location_master_list, place_master_list,
            search, items_per_page, current_page, search_result, total_items,
            handleSearch, clearSearch, onPageChange
        };
    }
};
</script>

<style>
</style>