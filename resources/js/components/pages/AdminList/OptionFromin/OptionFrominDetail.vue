<template>
	<div id="tab-7" class="tabcontent" style="display: block">
		<div class="page-title-top">
			<p>オプション長期詳細</p>
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
							</colgroup>
							<tbody>
								<tr>
									<td class="bg-gray">
										<span class="label-required">名前</span>
									</td>
									<td class="">
										{{ optionFromDetail.name }}
									</td>
									<td class="bg-gray">
										<span class="label-required">金額</span>
									</td>
									<td>
										<span class="text-red"
											><ThousandsSeparator
												:suffix="`円`"
												:number="optionFromDetail.money"
											/>
											円/</span
										>
										{{
											optionFromDetail.money_unit == "1"
												? "日"
												: "月"
										}}
									</td>
								</tr>
								<tr>
									<td class="bg-gray">
										<span class="label-required"
											>タイプ
										</span>
									</td>
									<td class="">
										<CommonMst
											:mstNm="`option_type`"
											v-model="optionFromDetail.type"
										></CommonMst>
									</td>
									<td class="bg-gray">
										<span class="label-required"
											>在庫管理</span
										>
									</td>
									<td>
										<CommonMst
											:mstNm="`option_item_yn`"
											v-model="optionFromDetail.item_yn"
										></CommonMst>
									</td>
								</tr>
								<tr>
									<td class="bg-gray">状態</td>
									<td colspan="3">
										<span
											v-if="
												optionFromDetail.option_fromins &&
												optionFromDetail
													.option_fromins[0]
											"
										>
											<CommonMst
												:mstNm="`status_nq`"
												v-model="
													optionFromDetail
														.option_fromins[0]
														.status
												"
											></CommonMst>
										</span>
									</td>
								</tr>
								<tr>
									<td class="bg-gray">From</td>
									<td colspan="3">
										<span
											v-if="
												optionFromDetail.option_fromins &&
												optionFromDetail
													.option_fromins[0] &&
												optionFromDetail
													.option_fromins[0]
													.fromin_id == '0'
											"
										>
											ALL
										</span>
										<span
											v-if="
												optionFromDetail.option_fromins &&
												optionFromDetail
													.option_fromins[0] &&
												optionFromDetail
													.option_fromins[0]
													.fromin_id != '0'
											"
										>
											{{
												optionFromDetail
													.option_fromins[0]
													.tsupport_country?.name
											}}
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
																optionFromDetail.option_fromins &&
																optionFromDetail
																	.option_fromins[0] &&
																optionFromDetail
																	.option_fromins[0]
																	.low_day_start
															"
															>{{
																optionFromDetail
																	.option_fromins[0] &&
																optionFromDetail
																	.option_fromins[0]
																	.low_day_start
																	? optionFromDetail
																			.option_fromins[0]
																			.low_day_start
																	: ""
															}}日〜{{
																optionFromDetail
																	.option_fromins[0] &&
																optionFromDetail
																	.option_fromins[0]
																	.low_day_end
															}}日</span
														>
													</td>
													<td
														class="text-right text-red"
													>
														<span
															v-if="
																optionFromDetail.option_fromins &&
																optionFromDetail
																	.option_fromins[0] &&
																optionFromDetail
																	.option_fromins[0]
																	.low_money
															"
															><ThousandsSeparator
																:suffix="`円`"
																:number="
																	optionFromDetail
																		.option_fromins[0]
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
																optionFromDetail.option_fromins &&
																optionFromDetail
																	.option_fromins[0] &&
																optionFromDetail
																	.option_fromins[0]
																	.medium_day_start
															"
															>{{
																optionFromDetail
																	.option_fromins[0] &&
																optionFromDetail
																	.option_fromins[0]
																	.medium_day_start
															}}日〜{{
																optionFromDetail
																	.option_fromins[0] &&
																optionFromDetail
																	.option_fromins[0]
																	.medium_day_end
															}}日</span
														>
													</td>
													<td
														class="text-right text-red"
													>
														<span
															v-if="
																optionFromDetail.option_fromins &&
																optionFromDetail
																	.option_fromins[0] &&
																optionFromDetail
																	.option_fromins[0]
																	.medium_money
															"
															><ThousandsSeparator
																:suffix="`円`"
																:number="
																	optionFromDetail
																		.option_fromins[0]
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
																optionFromDetail.option_fromins &&
																optionFromDetail
																	.option_fromins[0] &&
																optionFromDetail
																	.option_fromins[0]
																	.high_day_start
															"
															>{{
																optionFromDetail
																	.option_fromins[0] &&
																optionFromDetail
																	.option_fromins[0]
																	.high_day_start
															}}日〜{{
																optionFromDetail
																	.option_fromins[0] &&
																optionFromDetail
																	.option_fromins[0]
																	.high_day_end
															}}日</span
														>
													</td>
													<td
														class="text-right text-red"
													>
														<span
															v-if="
																optionFromDetail.option_fromins &&
																optionFromDetail
																	.option_fromins[0] &&
																optionFromDetail
																	.option_fromins[0]
																	.high_money
															"
															><ThousandsSeparator
																:suffix="`円`"
																:number="
																	optionFromDetail
																		.option_fromins[0]
																		.high_money
																"
														/></span>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td class="bg-gray">登録日時</td>
									<td class="">
										{{
											utils.formatDateTime(
												optionFromDetail.reg_dt
											)
										}}
									</td>
									<td class="bg-gray">更新日時</td>
									<td class="">
										{{
											utils.formatDateTime(
												optionFromDetail.upd_dt
											)
										}}
									</td>
								</tr>
							</tbody>
						</table>
						<div class="text-center group-btn">
							<router-link
								:to="{ name: 'option_from_list' }"
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
		const router = useRouter();
		const route = useRoute();
		const optionFromDetail = ref({});
		const store = useStore();
		const commonMst = computed(() => store.state.common);
		const loadCommonMst = () => {
			let mst_id = ["status_nq", "option_type", "option_item_yn"];
			store.dispatch("common/getCommonMst", mst_id);
		};
		const getOptionFromById = (id) => {
			ServiceAPI.axiosCall("option_from_detail", { id: id })
				.then((res) => {
					if (!res.error) {
						optionFromDetail.value = res.response;
					} else {
						router.push({
							name: "not-found",
						});
					}
				})
				.catch((err) => {
					console.log(err);
				});
		};

		loadCommonMst();
		getOptionFromById(route.params.id);
		return {
			utils,
			commonMst,
			optionFromDetail,
		};
	},
};
</script>

<style>
</style>