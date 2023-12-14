<template>
<div id="tab-4" class="tabcontent" style="display: block;">
    <div class="page-title-top">
        <p>商材一覧</p>
    </div>
    <div class="block-content-wrapper">
        <div class="block-content">
            <div class="block-group-search">
                <div class="search-row">
                    <div class="field-search">
                        <label for="001" class="label-control label-xl-small-device">ID</label>
                        <div class="field-search-input">
                            <input type="text" name="id" id="001" class="form-control" v-model="search.id">
                        </div>
                    </div>
                    <div class="field-search">
                        <label for="002" class="label-control label-xl-small-device">エリア</label>
                        <div class="field-search-input">
                            <select id="002" class="form-control" name="area_no" v-model="search.area_no">
                                <option value="">選択</option>
                                <option v-for="(value, key) in commonMst.support_country_area" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="field-search">
                        <label for="003" class="label-control label-xl">端末タイプ</label>
                        <div class="field-search-input">
                            <select id="003" class="form-control" name="terminal_type" v-model="search.terminal_type">
                                <option value="">選択</option>
                                <option v-for="(value, key) in commonMst.terminal_type" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="field-search">
                        <label for="004" class="label-control">通常料金</label>
                        <div class="field-search-input">
                            <input type="text" name="money_common" id="004" class="form-control" v-model="search.money_common">
                        </div>
                    </div>
                    <div class="field-search">
                        <label for="005" class="label-control label-xl">下限料金</label>
                        <div class="field-search-input">
                            <input type="text" name="" id="005" class="form-control" v-model="search.low_money">
                        </div>
                    </div>
                </div>
                <div class="search-row">
                    <div class="field-search">
                        <label for="006" class="label-control label-xl-small-device">状態</label>
                        <div class="field-search-input">
                            <select id="006" class="form-control" name="status" v-model="search.status">
                                <option value="">選択</option>
                                <option v-for="(value, key) in commonMst.status_nq" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="field-search">
                        <label for="007" class="label-control label-xl-small-device">対応国</label>
                        <div class="field-search-input">
                            <select id="007" class="form-control" name="support_country_id" v-model="search.support_country_id">
                                <option value="">選択</option>
                                <option v-for="item in support_country_list" :key="item.id"  :value="item.id">{{item.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="field-search">
                        <label for="008" class="label-control label-xl">通信タイプ</label>
                        <div class="field-search-input">
                            <select id="008" class="form-control" name="terminal_model" v-model="search.terminal_model">
                                <option value="">選択</option>
                                <option v-for="(value, key) in commonMst.terminal_model" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="field-search">
                        <label for="009" class="label-control">早割料金</label>
                        <div class="field-search-input">
                            <input type="text" name="money_fast" id="009" class="form-control" v-model="search.money_fast">
                        </div>
                    </div>
                    <div class="field-search">
                        <label for="0010" class="label-control label-xl">日数従量料金</label>
                        <div class="field-search-input">
                            <input type="text" name="medium_money" id="0010" class="form-control" v-model="search.medium_money">
                        </div>
                    </div>
                </div>
                <div class="search-row">
                    <div class="field-search field-mobile-hidden">
                    </div>
                    <div class="field-search">
                        <label for="0011" class="label-control label-xl-small-device">周遊</label>
                        <div class="field-search-input">
                            <select id="0011" class="form-control" name="support_country_group_id" v-model="search.support_country_group_id">
                                <option value="">選択</option>
                                <option v-for="item in support_country_group_list" :key="item.id"  :value="item.id">{{item.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="field-search field-2w field-mobile-hidden"></div>
                    <div class="field-search">
                        <label for="0012" class="label-control label-xl">上限料金</label>
                        <div class="field-search-input">
                            <input type="text" name="high_money" id="0012" class="form-control" v-model="search.high_money">
                        </div>
                    </div>
                    <div class="field-search">
                        <div class="field-search-input ml-20px">
                            <a href="" class="btn btn-black" @click.prevent="handleSearch">
                                <i class="fas fa-search"></i>&nbsp;&nbsp;&nbsp;
                                <span>検索</span>
                            </a>
                            <a href="" class="btn btn-gray" @click.prevent="clearSearch">クリア</a>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-red fs-10px mb-10px">※早割料金は 申込日が3日前の場合に適用されます</p>
            <div class="block-search-result">
                <div class="search-result-top">
                    <div class="search-result-title">
                        該当：{{$filters.formatNumber(search_result.total)}}件
                    </div>
                    <div class="d-flex-center-y">
                        <select id="001xx" class="form-control flex-1" v-model="search.order_by" @change="handleSearch">
                            <option v-for="item in list_sort" :key="item.value"  :value="item.value">{{item.text}}件</option>
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
                            <col style="width: 100px;">
                            <col style="width: 180px;">
                            <col style="width: 60px;">
                            <col style="width: 60px;">
                            <col style="width: 60px;">
                            <col style="width: 180px;">
                            <col style="width: 60px;">
                            <col style="width: 250px;">
                            <col style="width: 70px;">
                            <col style="width: 320px;">
                            <col style="width: 230px;">
                            <col style="width: 130px;">
                            <col style="width: 80px;">
                        </colgroup>
                        <thead>
                            <tr class="bg-gray text-center">
                                <td>ID</td>
                                <td>エリア</td>
                                <td>対応国</td>
                                <td>周遊</td>
                                <td>端末<br>タイプ</td>
                                <td>通信<br>タイプ</td>
                                <td>補足</td>
                                <td>状態</td>
                                <td>通常料金</td>
                                <td>長期状態</td>
                                <td>長期プラン料金</td>
                                <td>端末</td>
                                <td>登録日時</td>
                                <td>詳細</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in search_result.data" :key="row.id" :class="{'bg-gray': index % 2 !== 0 }">
                                <td class="text-center">{{row.id}}</td>
                                <td class="text-navi"><CommonMst :mstNm="`support_country_area`" v-model="row.support_country.area_no"></CommonMst></td>
                                
                                <td>{{row.support_country.name}}</td>
                                <td>{{row.support_country_group ? row.support_country_group.name : ''}}</td>
                                <td class="text-center text-red"><CommonMst :mstNm="`terminal_type`" v-model="row.terminal_type"></CommonMst></td>
                                <td class="text-center text-blue"><CommonMst :mstNm="`terminal_model`" v-model="row.terminal_model"></CommonMst></td>
                                <td>{{row.terminal_sub_info}}</td>
                                <td class="text-center text-navi"><CommonMst :mstNm="`status_nq`" v-model="row.status"></CommonMst></td>
                                <td>
                                    <table class="table table-fixed table-nested">
                                        <colgroup>
                                            <col style="width: 60%;">
                                            <col style="width: 40%;">
                                        </colgroup>
                                        <tbody v-if="row.type == 'C'">
                                            <tr>
                                                <td class="text-navi">通常料金</td>
                                                <td class="text-right text-red">{{$filters.formatNumber(row.money_common)}} 円</td>
                                            </tr>
                                            <tr>
                                                <td class="text-green">複数カ国料金</td>
                                                <td class="text-right text-red">{{$filters.formatNumber(row.money_multi)}} 円</td>
                                            </tr>
                                            <tr>
                                                <td class="">早割料金</td>
                                                <td class="text-right text-red">{{$filters.formatNumber(row.money_fast)}} 円</td>
                                            </tr>
                                        </tbody>
                                        <tbody v-else>
                                            <tr>
                                                <td class="text-navi">通常料金</td>
                                                <td class="text-right text-red">{{$filters.formatNumber(row.money_common)}} 円</td>
                                            </tr>
                                            <tr>
                                                <td class="">早割料金</td>
                                                <td class="text-right text-red">{{$filters.formatNumber(row.money_fast)}} 円</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <!-- {{ commonMst.status_nq?.[(row.product_long && row.product_long.status) ? row.product_long.status : '']?.['disp_value'] }} -->
                                    <span v-if="row.product_long && row.product_long.status"><CommonMst :mstNm="`status_nq`" v-model="row.product_long.status"></CommonMst></span>
                                </td>
                                
                                <td>
                                    <table class="table table-fixed table-nested" v-if="row.product_long">
                                        <colgroup>
                                            <col style="width: 32%;">
                                            <col style="width: 40%;">
                                            <col style="width: 28%;">
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <td><span v-if="row.product_long.low_day_start">{{row.product_long.low_day_start}}日〜{{row.product_long.low_day_end}}日</span></td>
                                                <td class="text-navi">下限料金</td>
                                                <td class="text-right text-red"><ThousandsSeparator :suffix="`円`" :number="row.product_long.low_money"/></td>
                                            </tr>
                                            <tr>
                                                <td><span v-if="row.product_long.medium_day_start">{{row.product_long.medium_day_start}}日〜{{row.product_long.medium_day_end}}日</span></td>
                                                <td class="text-green">日数従量料金</td>
                                                <td class="text-right text-red"><ThousandsSeparator :suffix="`円`" :number="row.product_long.medium_money"/></td>
                                            </tr>
                                            <tr>
                                                <td><span v-if="row.product_long.high_day_start">{{row.product_long.high_day_start}}日〜{{row.product_long.high_day_end}}日</span></td>
                                                <td class="">上限料金</td>
                                                <td class="text-right text-red"><ThousandsSeparator :suffix="`円`" :number="row.product_long.high_money"/></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="">
                                    <ul class="list-unstyled">
                                        <li v-for="item in row.product_terminals" :key="item.id">{{item.terminal.name}}</li>
                                    </ul>
                                </td>
                                <td class="text-center">{{utils.formatDateTime(row.reg_dt)}}</td>
                                <td class="text-center">
                                    <router-link :to="{name: 'product_detail', params:{id: row.id}}" class="btn btn-primary" title="詳細">詳細</router-link>
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
import ThousandsSeparator from "@/components/partials/ThousandsSeparator.vue";
import PaginationBase from "@/components/plugins/PaginationBase.vue";
import CommonMst from "@/components/partials/CommonMst.vue"
import { computed, ref } from "vue";
import { useStore } from "vuex";
import ServiceAPI from "@/service/api";
import utils from "@/service/utils";

export default {
	components: { ThousandsSeparator, PaginationBase, CommonMst },
	setup() {
		let total_items = ref(0);
		let current_page = ref(1);
		let items_per_page = ref(15);
		const search_result = ref({});
		let default_search = {
			order_by: "-reg_dt",
			per_page: items_per_page.value,
			page: 1,
			area_no: "",
			terminal_type: "",
			money_common: "",
			low_money: "",
			status: "",
			support_country_id: "",
			terminal_model: "",
			money_fast: "",
			medium_money: "",
			support_country_group_id: "",
			high_money: "",
			screen_nm: "product_list",
		};
		const list_sort = [
			{ value: "+reg_dt", text: "登録日古順" },
			{ value: "-reg_dt", text: "登録日新順" },
		];
		const support_country_list = ref([]);
		const support_country_group_list = ref([]);
		const search = ref(Object.assign({}, default_search));
		const store = useStore();
		const commonMst = computed(() => store.state.common);
		const loadCommonMst = () => {
			let mst_id = [
				"support_country_area",
				"terminal_type",
				"status_nq",
				"terminal_model",
			];
			store.dispatch("common/getCommonMst", mst_id);
		};
        const supportCountryGroupList = ()=>{
            ServiceAPI.axiosCall("support_country_group_list", {})
                .then((res) => {
                    if(!res.error){
                        support_country_group_list.value = res.response
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

		const productListSearch = () => {
			search.value.page = current_page.value;
			search.value.per_page = items_per_page.value;
			ServiceAPI.axiosCall("product_list", search.value)
				.then((res) => {
					if (!res.error) {
						search_result.value = res.response;
						total_items.value = res.response.total;
					}
				})
				.catch((err) => {
					console.log(err);
				});
		};

		const clearSearch = () => {
			current_page.value = default_search.page;
			search.value = Object.assign({}, default_search);
			search.value.btn = "clear";
			productListSearch();
		};

		const handleSearch = () => {
			search.value.btn = "search";
			current_page.value = default_search.page;
			productListSearch();
		};

		const onPageChange = () => {
			search.value.btn = "";
			productListSearch();
		};

		const searchCondition = () => {
			ServiceAPI.axiosCall("search_condition", {
				screen_nm: "product_list",
			})
				.then((res) => {
					if (!res.error) {
						if (Object.keys(res.response).length) {
							search.value = Object.assign(
								search.value,
								res.response
							);
							if (res.response.page) {
								current_page.value = res.response.page;
							}
							if (res.response.per_page) {
								items_per_page.value = res.response.per_page;
							}
						}
						productListSearch();
					}
				})
				.catch((err) => {
					console.log(err);
				});
		};

		loadCommonMst();
		supportCountryList();
		supportCountryGroupList();
		searchCondition();

		return {
			utils,
			commonMst,
			search,
			support_country_list,
			support_country_group_list,
			clearSearch,
			handleSearch,
			list_sort,
			search_result,
			current_page,
			items_per_page,
			onPageChange,
			total_items,
		};
	},
};
</script>

<style>
</style>