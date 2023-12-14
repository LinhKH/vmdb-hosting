<template>
	<div id="tab-6" class="tabcontent" style="display: block">
		<div class="page-title-top">
			<p>商材詳細</p>
		</div>
		<div class="block-content-wrapper">
			<div class="block-content">
				<div class="block-search-result w-per-60 m-auto">
					<div class="edit-page-content">
						<table class="table table-bordered">
							<colgroup>
								<col style="width: 170px" />
								<col style="width: 250px" />
								<col style="width: 170px" />
								<col style="width: 250px" />
								<col style="width: 170px" />
								<col style="width: 250px" />
							</colgroup>
							<tbody>
								<tr>
									<td class="bg-gray">ID</td>
									<td class="" colspan="5">
										{{ optionDetail.id }}
									</td>
								</tr>
								<tr>
									<td class="bg-gray">状態</td>
									<td>
										<CommonMst
											:mstNm="`status_nq`"
											v-model="optionDetail.status"
										></CommonMst>
									</td>
									<td class="bg-gray">プラン対象</td>
									<td colspan="3">
                                        <CommonMst
											:mstNm="`option_plan_yn`"
											v-model="optionDetail.plan_yn"
										></CommonMst>
									</td>
								</tr>
								<tr>
									<td class="bg-gray">名前</td>
									<td class="" colspan="5">
                                        {{ optionDetail.display_name }}
									</td>
								</tr>
								<tr>
									<td class="bg-gray">消費税タイプ</td>
									<td>
										<CommonMst
											:mstNm="`tax_type`"
											v-model="optionDetail.tax_type"
										></CommonMst>
									</td>
									<td class="bg-gray">定価</td>
									<td>
										<span class="text-red"
											><ThousandsSeparator
												:suffix="``"
												:number="optionDetail.proper"
											/>
											円/</span
										>
										{{
											optionDetail.money_unit == "1"
												? "日"
												: "月"
										}}
									</td>
									<td class="bg-gray">金額</td>
									<td class="text-red">
										<ThousandsSeparator
											:suffix="`円`"
											:number="optionDetail.money"
										/>
									</td>
								</tr>
								<tr>
									<td class="bg-gray">タイプ</td>
									<td>
										<CommonMst
											:mstNm="`option_type`"
											v-model="optionDetail.type"
										></CommonMst>
									</td>
									<td class="bg-gray">不備チェック</td>
									<td colspan="3">
										<CommonMst
											:mstNm="`loss_check`"
											v-model="optionDetail.loss_check"
										></CommonMst>
									</td>
								</tr>
								<tr class="tb-title-row">
									<td colspan="6">サイト側設定</td>
								</tr>
								<tr>
									<td class="bg-gray">表示名</td>
									<td class="" colspan="5">
										{{ optionDetail.name }}
									</td>
								</tr>
								<tr>
									<td class="bg-gray">小計算出方法</td>
									<td>
										<CommonMst
											:mstNm="`calc_type`"
											v-model="optionDetail.calc_type"
										></CommonMst>
									</td>
									<td class="bg-gray">グループ化識別文字</td>
									<td colspan="3">
										{{ optionDetail.choice_group_id }}
									</td>
								</tr>
								<tr>
									<td class="bg-gray">
										オプションインクルード
									</td>
									<td class="" colspan="5">
										{{ getIncludeCalcIds }}
									</td>
								</tr>
								<tr>
									<td class="bg-gray">補足</td>
									<td class="" colspan="5">
										<p>
											{{ optionDetail.sub_info }}
										</p>
										<span class="text-red"
											>※補足文はサイト側に表示されます</span
										>
									</td>
								</tr>
								<tr>
									<td class="bg-gray">サイト表示制御</td>
									<td class="" colspan="5">
										{{
											getSiteShowCodeName(
												optionDetail.site_show_codes
											)
										}}
									</td>
								</tr>
								<tr class="tb-title-row">
									<td colspan="6">長期プラン</td>
								</tr>
								<tr>
									<td class="bg-gray">状態</td>
									<td class="" colspan="5">
										<span
											v-if="
												optionDetail.option_longs &&
												optionDetail.option_longs[0]
											"
										>
											<CommonMst
												:mstNm="`status_nq`"
												v-model="
													optionDetail.option_longs[0]
														.status
												"
											></CommonMst>
										</span>
									</td>
								</tr>
								<tr>
									<td class="bg-gray">下限料金</td>
									<td colspan="5">
										<table
											class="table table-fixed table-nested w-per-40"
										>
											<colgroup>
												<col style="width: 60%" />
												<col style="width: 40%" />
											</colgroup>
											<tbody>
												<tr>
													<td class="">
														<span
															v-if="
																optionDetail.option_longs &&
																optionDetail
																	.option_longs[0] &&
																optionDetail
																	.option_longs[0]
																	.low_day_start
															"
															>{{
																optionDetail
																	.option_longs[0] &&
																optionDetail
																	.option_longs[0]
																	.low_day_start
																	? optionDetail
																			.option_longs[0]
																			.low_day_start
																	: ""
															}}日〜{{
																optionDetail
																	.option_longs[0] &&
																optionDetail
																	.option_longs[0]
																	.low_day_end
															}}日</span
														>
													</td>
													<td
														class="text-right text-red"
													>
														<span
															v-if="
																optionDetail.option_longs &&
																optionDetail
																	.option_longs[0] &&
																optionDetail
																	.option_longs[0]
																	.low_money
															"
															><ThousandsSeparator
																:suffix="`円`"
																:number="
																	optionDetail
																		.option_longs[0]
																		.low_money
																"
														/></span>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td class="bg-gray">日数従量料金</td>
									<td colspan="5">
										<table
											class="table table-fixed table-nested w-per-40"
										>
											<colgroup>
												<col style="width: 60%" />
												<col style="width: 40%" />
											</colgroup>
											<tbody>
												<tr>
													<td class="">
														<span
															v-if="
																optionDetail.option_longs &&
																optionDetail
																	.option_longs[0] &&
																optionDetail
																	.option_longs[0]
																	.medium_day_start
															"
															>{{
																optionDetail
																	.option_longs[0] &&
																optionDetail
																	.option_longs[0]
																	.medium_day_start
															}}日〜{{
																optionDetail
																	.option_longs[0] &&
																optionDetail
																	.option_longs[0]
																	.medium_day_end
															}}日</span
														>
													</td>
													<td
														class="text-right text-red"
													>
														<span
															v-if="
																optionDetail.option_longs &&
																optionDetail
																	.option_longs[0] &&
																optionDetail
																	.option_longs[0]
																	.medium_money
															"
															><ThousandsSeparator
																:suffix="`円`"
																:number="
																	optionDetail
																		.option_longs[0]
																		.medium_money
																"
														/></span>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td class="bg-gray">上限料金</td>
									<td colspan="5">
										<table
											class="table table-fixed table-nested w-per-40"
										>
											<colgroup>
												<col style="width: 60%" />
												<col style="width: 40%" />
											</colgroup>
											<tbody>
												<tr>
													<td class="">
														<span
															v-if="
																optionDetail.option_longs &&
																optionDetail
																	.option_longs[0] &&
																optionDetail
																	.option_longs[0]
																	.high_day_start
															"
															>{{
																optionDetail
																	.option_longs[0] &&
																optionDetail
																	.option_longs[0]
																	.high_day_start
															}}日〜{{
																optionDetail
																	.option_longs[0] &&
																optionDetail
																	.option_longs[0]
																	.high_day_end
															}}日</span
														>
													</td>
													<td
														class="text-right text-red"
													>
														<span
															v-if="
																optionDetail.option_longs &&
																optionDetail
																	.option_longs[0] &&
																optionDetail
																	.option_longs[0]
																	.high_money
															"
															><ThousandsSeparator
																:suffix="`円`"
																:number="
																	optionDetail
																		.option_longs[0]
																		.high_money
																"
														/></span>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr class="tb-title-row">
									<td colspan="6">対応国</td>
								</tr>
								<tr>
									<td class="bg-gray">対応国</td>
									<td class="" colspan="5">
										{{
											utils.getTermialName(
												optionDetail.option_country_relation,
												"support_conutry"
											)
										}}
									</td>
								</tr>
								<tr>
									<td class="bg-gray">登録日付</td>
									<td>
										{{
											utils.formatDateTime(
												optionDetail.reg_dt
											)
										}}
									</td>
									<td class="bg-gray">更新日付</td>
									<td colspan="3">
										{{
											utils.formatDateTime(
												optionDetail.upd_dt
											)
										}}
									</td>
								</tr>
							</tbody>
						</table>
						<div class="text-center group-btn">
							<router-link
								:to="{ name: 'option_list' }"
								class="btn btn-gray"
								title="一覧へ"
								>一覧へ</router-link
							>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import ServiceAPI from "@/service/api";
import ThousandsSeparator from "@/components/partials/ThousandsSeparator.vue";
import CommonMst from "@/components/partials/CommonMst.vue";
import { useRoute, useRouter } from "vue-router";
import { computed, ref } from "vue";
import { useStore } from "vuex";
import utils from "@/service/utils";
export default {
	components: { ThousandsSeparator, CommonMst },
	setup() {
		const route = useRoute();
		const router = useRouter();
		const optionDetail = ref({});
		const optionDetailByArrId = ref([]);
		const store = useStore();
		const commonMst = computed(() => store.state.common);
		const loadCommonMst = () => {
			let mst_id = [
				"status_nq",
				"support_country_stop_yn",
				"status_yn",
				"option_type",
				"option_plan_yn",
				"tax_type",
				"loss_check",
				"calc_type",
				"site_show",
			];
			store.dispatch("common/getCommonMst", mst_id);
		};
		const getProductById = (id) => {
			ServiceAPI.axiosCall("option_detail", { id: id })
				.then((res) => {
					if (!res.error) {
						optionDetail.value = res.response;
						getProductByArrId(optionDetail.value.include_calc_ids);
					} else {
                        router.push({
                            name: 'not-found',
                        })
                    }
				})
				.catch((err) => {
					console.log(err);
				});
		};
		const getProductByArrId = (strId = "") => {
			if (strId) {
				let arrId = strId.split(",");
				ServiceAPI.axiosCall("option_detail_by_id", { id: arrId })
					.then((res) => {
						if (!res.error) {
							optionDetailByArrId.value = res.response;
						}
					})
					.catch((err) => {
						console.log(err);
					});
			}
		};
		const getIncludeCalcIds = computed(() => {
			var arrVal = [];
			if (optionDetailByArrId.value) {
				optionDetailByArrId.value.forEach(function (value) {
					if (value.name && !arrVal.includes(value.name)) {
						arrVal.push(value.name);
					}
				});
			}
			return arrVal.join(", ");
		});
		const getSiteShowCodeName = (site_show_codes = "") => {
			if (site_show_codes) {
				var siteShow = site_show_codes.split(",");
				var arrVal = [];
				if (commonMst.value) {
					var arrCommon = Object.values(
						JSON.parse(JSON.stringify(commonMst.value.site_show))
					);
				}
				if (arrCommon) {
					arrCommon.forEach(function (value) {
						if (siteShow.includes(value.code_value)) {
							arrVal.push(value.disp_value);
						}
					});
				}
				return arrVal.join(", ");
			}
		};
		loadCommonMst();
		getProductByArrId();
		getProductById(route.params.id);
		return {
			utils,
			commonMst,
			optionDetail,
			getSiteShowCodeName,
			getProductByArrId,
			getIncludeCalcIds,
		};
	},
};
</script>

<style>
</style>