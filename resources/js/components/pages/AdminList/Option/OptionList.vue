<template>
	<div id="tab-6" class="tabcontent" style="display: block">
		<div class="page-title-top">
			<p>オプション一覧</p>
		</div>
		<div class="block-content-wrapper">
			<div class="block-content">
				<div class="block-group-search">
					<div class="search-row">
						<div class="field-search">
							<label for="001" class="label-control">ID</label>
							<div class="field-search-input">
								<input
									type="text"
									name="id"
									id="001"
									class="form-control"
									v-model="search.id"
								/>
							</div>
						</div>
						<div class="field-search">
							<label for="002" class="label-control">名前</label>
							<div class="field-search-input">
								<input
									type="text"
									name="name"
									id="002"
									class="form-control"
									v-model="search.name"
								/>
							</div>
						</div>
						<div class="field-search">
							<label for="003" class="label-control"
								>タイプ</label
							>
							<div class="field-search-input">
								<select
									id="003"
									class="form-control"
									name="type"
									v-model="search.type"
								>
									<option value="">選択</option>
									<option
										v-for="(
											value, key
										) in commonMst.option_type"
										:key="key"
										:value="value.code_value"
									>
										{{ value.disp_value }}
									</option>
								</select>
							</div>
						</div>
						<div class="field-search">
							<div class="field-search-input ml-20px">
								<a
									href=""
									class="btn btn-black"
									@click.prevent="handleSearch"
								>
									<i class="fas fa-search"></i
									>&nbsp;&nbsp;&nbsp;
									<span>検索</span>
								</a>
								<a
									href=""
									class="btn btn-gray"
									@click.prevent="clearSearch"
									>クリア</a
								>
							</div>
						</div>
					</div>
				</div>
				<div class="block-search-result">
					<div class="search-result-top">
						<div class="search-result-title">
							該当：{{
								$filters.formatNumber(search_result.total)
							}}件
						</div>
						<div class="d-flex-center-y">
							<select
								id="001xx"
								class="form-control flex-1"
								v-model="search.order_by"
								@change="handleSearch"
							>
								<option
									v-for="item in list_sort"
									:key="item.value"
									:value="item.value"
								>
									{{ item.text }}件
								</option>
							</select>
							<label for="002xx" class="label-control"
								>表示数</label
							>
							<select
								id="002xx"
								class="form-control flex-1"
								v-model="items_per_page"
								@change="handleSearch"
							>
								<option
									v-for="item in utils.getListItemPerPage()"
									:key="item"
									:value="item"
								>
									{{ item }}件
								</option>
							</select>
						</div>
					</div>
					<div class="search-result-table">
						<table class="table table-bordered table-fixed">
							<colgroup>
								<col style="width: 80px" />
								<col style="width: 70px" />
								<col style="width: 120px" />
								<col style="width: 290px" />
								<col style="width: 100px" />
								<col style="width: 110px" />
								<col style="width: 80px" />
								<col style="width: 80px" />
								<col style="width: 280px" />
								<col style="width: 160px" />
								<col style="width: 280px" />
								<col style="width: 130px" />
								<col style="width: 80px" />
							</colgroup>
							<thead>
								<tr class="bg-gray text-center">
									<td>ID</td>
									<td>状態</td>
									<td>グループ</td>
									<td>名前</td>
									<td>申込制限</td>
									<td>金額</td>
									<td>直前不可</td>
									<td>長期状態</td>
									<td>長期プラン料金</td>
									<td>タイプ</td>
									<td>補足</td>
									<td>登録日時</td>
									<td>詳細</td>
								</tr>
							</thead>
							<tbody>
								<tr
									v-for="(row, index) in search_result.data"
									:key="row.id"
									:class="{ 'bg-gray': index % 2 !== 0 }"
								>
									<td class="text-right">{{ row.id }}</td>
									<td class="text-center text-navi">
										<CommonMst
											:mstNm="`status_nq`"
											v-model="row.status"
										></CommonMst>
									</td>
									<td class="text-center">
										{{ row.choice_group_id }}
									</td>
									<td>{{ row.display_name }} 容量</td>
									<td class="text-center text-blue">
										<span
											><CommonMst
												:mstNm="`support_country_stop_yn`"
												v-model="row.stop_yn"
											></CommonMst
										></span>
									</td>
									<td class="text-right">
										<span class="text-red">{{
											row.money
										}}</span>
										{{
											row.money_unit == "1"
												? "円 / 日"
												: "円 / 月"
										}}
									</td>
									<td
										class="text-center"
										:class="{
											'text-blue':
												row.just_before_ng == 'Y',
											'text-red':
												row.just_before_ng == 'N',
										}"
									>
										<span
											><CommonMst
												:mstNm="`status_yn`"
												v-model="row.just_before_ng"
											></CommonMst
										></span>
									</td>
									<td class="text-center text-green">
										<span v-if="
													row.option_longs &&
													row.option_longs[0]
												"><CommonMst
												:mstNm="`status_nq`"
												v-model="row.option_longs[0].status"
											></CommonMst></span>
									</td>
									<td>
										<table
											class="table table-fixed table-nested"
										>
											<colgroup>
												<col style="width: 32%" />
												<col style="width: 40%" />
												<col style="width: 28%" />
											</colgroup>
											<tbody
												v-if="
													row.option_longs &&
													row.option_longs[0]
												"
											>
												<tr>
													<td>
														<span
															v-if="
																row
																	.option_longs[0][
																	'low_day_start'
																]
															"
															>{{
																row
																	.option_longs[0][
																	"low_day_start"
																]
															}}日〜{{
																row
																	.option_longs[0][
																	"low_day_end"
																]
															}}日</span
														>
													</td>
													<td class="text-navi">
														下限料金
													</td>
													<td
														class="text-right text-red"
													>
														<ThousandsSeparator
															:suffix="`円`"
															:number="
																row
																	.option_longs[0][
																	'low_money'
																]
															"
														/>
													</td>
												</tr>
												<tr>
													<td>
														<span
															v-if="
																row
																	.option_longs[0]
																	.medium_day_start
															"
															>{{
																row
																	.option_longs[0]
																	.medium_day_start
															}}日〜{{
																row
																	.option_longs[0]
																	.medium_day_end
															}}日</span
														>
													</td>
													<td class="text-green">
														日数従量料金
													</td>
													<td
														class="text-right text-red"
													>
														<ThousandsSeparator
															:suffix="`円`"
															:number="
																row
																	.option_longs[0]
																	.medium_money
															"
														/>
													</td>
												</tr>
												<tr>
													<td>
														<span
															v-if="
																row
																	.option_longs[0]
																	.high_day_start
															"
															>{{
																row
																	.option_longs[0]
																	.high_day_start
															}}日〜{{
																row
																	.option_longs[0]
																	.high_day_end
															}}日</span
														>
													</td>
													<td class="text-bronze">上限料金</td>
													<td
														class="text-right text-red"
													>
														<ThousandsSeparator
															:suffix="`円`"
															:number="
																row
																	.option_longs[0]
																	.high_money
															"
														/>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
									<td
										class="text-center"
										:class="[
											row.type == '1'
												? 'text-green'
												: row.type == '2'
												? 'text-blue'
												: '',
										]"
									>
										<CommonMst
											:mstNm="`option_type`"
											v-model="row.type"
										></CommonMst>
									</td>
									<td>
										{{ $filters.str_limit(row.sub_info, 50) }}
									</td>
									<td class="text-center">
										{{ utils.formatDateTime(row.reg_dt) }}
									</td>
									<td class="text-center">
										<router-link
											:to="{
												name: 'option_detail',
												params: { id: row.id },
											}"
											class="btn btn-primary"
											title="詳細"
											>詳細</router-link
										>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="search-pagination">
						<p class="search-result-title">
							<span
								>{{
									$filters.formatNumber(search_result.from)
								}}〜{{
									$filters.formatNumber(search_result.to)
								}}</span
							>
							&nbsp;/&nbsp;
							<span
								>{{
									$filters.formatNumber(search_result.total)
								}}件</span
							>
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
import CommonMst from "@/components/partials/CommonMst.vue";
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
			id: "",
			name: "",
			type: "",
			screen_nm: "option_list",
		};
		const list_sort = [
			{ value: "+reg_dt", text: "登録日古順" },
			{ value: "-reg_dt", text: "登録日新順" },
			{ value: "+order_no", text: "表示順" },
		];
		const search = ref(Object.assign({}, default_search));
		const store = useStore();
		const commonMst = computed(() => store.state.common);
		const loadCommonMst = () => {
			let mst_id = [
				"status_nq",
				"support_country_stop_yn",
				"status_yn",
				"option_type",
			];
			store.dispatch("common/getCommonMst", mst_id);
		};

		const optionListSearch = () => {
			search.value.page = current_page.value;
			search.value.per_page = items_per_page.value;
			ServiceAPI.axiosCall("option_list", search.value)
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
			optionListSearch();
		};

		const handleSearch = () => {
			search.value.btn = "search";
			current_page.value = default_search.page;
			optionListSearch();
		};

		const onPageChange = () => {
			search.value.btn = "";
			optionListSearch();
		};

		const searchCondition = () => {
			ServiceAPI.axiosCall("search_condition", {
				screen_nm: "option_list",
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
						optionListSearch();
					}
				})
				.catch((err) => {
					console.log(err);
				});
		};

		loadCommonMst();
		searchCondition();

		return {
			utils,
			commonMst,
			search,
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