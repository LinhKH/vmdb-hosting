<template>
	<div id="tab-4" class="tabcontent" style="display: block">
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
								<col style="" />
								<col style="width: 170px" />
								<col style="" />
							</colgroup>
							<tbody>
								<tr>
									<td class="bg-gray">ID</td>
									<td class="" colspan="3">
										{{ productDetail.id }}
									</td>
								</tr>
								<tr>
									<td class="bg-gray">状態</td>
									<td colspan="3">
                                        <CommonMst :mstNm="`status_nq`" v-model="productDetail.status"></CommonMst>
									</td>
								</tr>
								<tr>
									<td class="bg-gray">タイプ</td>
									<td colspan="3"><CommonMst :mstNm="`product_type`" v-model="productDetail.type"></CommonMst></td>
								</tr>
								<tr>
									<td class="bg-gray">国</td>
									<td class="" colspan="3">
										{{productDetail.support_country ? productDetail.support_country.name : ''}}
									</td>
								</tr>
								<tr>
									<td class="bg-gray">端末タイプ</td>
									<td colspan="3"><CommonMst :mstNm="`terminal_type`" v-model="productDetail.terminal_type"></CommonMst></td>
								</tr>
								<tr>
									<td class="bg-gray">通信タイプ</td>
									<td colspan="3"><CommonMst :mstNm="`terminal_model`" v-model="productDetail.terminal_model"></CommonMst></td>
								</tr>
								<tr>
									<td class="bg-gray">
										サイト表示用通信タイプ
									</td>
									<td class="" colspan="3"><CommonMst :mstNm="`terminal_model_price`" v-model="productDetail.terminal_model_type"></CommonMst></td>
								</tr>
								<tr>
									<td class="bg-gray">補足</td>
									<td colspan="3">{{productDetail.terminal_sub_info}}</td>
								</tr>
								<tr>
									<td class="bg-gray">料金</td>
									<td colspan="3">
										<table
											class="table table-fixed table-nested w-per-40"
										>
											<colgroup>
												<col style="width: 60%" />
												<col style="width: 40%" />
											</colgroup>
											<tbody v-if="productDetail.type == 'C'">
                                                <tr>
                                                    <td class="text-navi">通常料金</td>
                                                    <td class="text-right text-red"><ThousandsSeparator :suffix="`円`" :number="productDetail.money_common"/></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-green">複数カ国料金</td>
                                                    <td class="text-right text-red"><ThousandsSeparator :suffix="`円`" :number="productDetail.money_multi"/></td>
                                                </tr>
                                                <tr>
                                                    <td class="">早割料金</td>
                                                    <td class="text-right text-red"><ThousandsSeparator :suffix="`円`" :number="productDetail.money_fast"/></td>
                                                </tr>
                                            </tbody>
                                            <tbody v-else>
                                                <tr>
                                                    <td class="text-navi">通常料金</td>
                                                    <td class="text-right text-red"><ThousandsSeparator :suffix="`円`" :number="productDetail.money_common"/></td>
                                                </tr>
                                                <tr>
                                                    <td class="">早割料金</td>
                                                    <td class="text-right text-red"><ThousandsSeparator :suffix="`円`" :number="productDetail.money_fast"/></td>
                                                </tr>
                                            </tbody>
										</table>
									</td>
								</tr>
								<tr class="tb-title-row">
									<td colspan="4">長期プラン</td>
								</tr>
								<tr>
									<td class="bg-gray">状態</td>
									<td class="" colspan="3">
                                        <span v-if="productDetail.product_long && productDetail.product_long.status"><CommonMst :mstNm="`status_nq`" v-model="productDetail.product_long.status"></CommonMst></span>
                                    </td>
								</tr>
								<tr>
									<td class="bg-gray">下限料金</td>
									<td colspan="3">
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
														<span v-if="productDetail.product_long && productDetail.product_long.low_day_start">{{ (productDetail.product_long && productDetail.product_long.low_day_start) ? productDetail.product_long.low_day_start : ''}}日〜{{productDetail.product_long && productDetail.product_long.low_day_end}}日</span>
													</td>
													<td
														class="text-right text-red"
													>
														<span v-if="productDetail.product_long && productDetail.product_long.low_money"><ThousandsSeparator :suffix="`円`" :number="productDetail.product_long.low_money"/></span>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td class="bg-gray">日数従量料金</td>
									<td colspan="3">
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
														<span v-if="productDetail.product_long && productDetail.product_long.medium_day_start">{{productDetail.product_long && productDetail.product_long.medium_day_start}}日〜{{productDetail.product_long && productDetail.product_long.medium_day_end}}日</span>
													</td>
													<td
														class="text-right text-red"
													>
														<span v-if="productDetail.product_long  && productDetail.product_long.medium_money"><ThousandsSeparator :suffix="`円`" :number="productDetail.product_long.medium_money"/></span>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td class="bg-gray">上限料金</td>
									<td colspan="3">
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
														<span v-if="productDetail.product_long && productDetail.product_long.high_day_start">{{productDetail.product_long && productDetail.product_long.high_day_start}}日〜{{productDetail.product_long && productDetail.product_long.high_day_end}}日</span>
													</td>
													<td
														class="text-right text-red"
													>
														<span v-if="productDetail.product_long && productDetail.product_long.high_money"><ThousandsSeparator :suffix="`円`" :number="productDetail.product_long.high_money"/></span>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr class="tb-title-row">
									<td colspan="4">端末</td>
								</tr>
								<tr>
									<td class="bg-gray">商品名</td>
									<td class="" colspan="3">
                                        {{utils.getTermialName(productDetail.product_terminals)}}
									</td>
								</tr>
								<tr>
									<td class="bg-gray">登録日付</td>
									<td>{{utils.formatDateTime(productDetail.reg_dt)}}</td>
									<td class="bg-gray">更新日付</td>
									<td>{{utils.formatDateTime(productDetail.upd_dt)}}</td>
								</tr>
							</tbody>
						</table>
						<div class="text-center group-btn">
                            <router-link :to="{name: 'product_list'}" class="btn btn-gray" title="一覧へ">一覧へ</router-link>
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
import CommonMst from "@/components/partials/CommonMst.vue"
import { useRoute, useRouter } from "vue-router";
import { computed, ref } from "vue";
import { useStore } from "vuex";
import utils from "@/service/utils";
export default {
    components: { ThousandsSeparator, CommonMst },
	setup() {
		const route = useRoute();
		const router = useRouter();
		const productDetail = ref({});
        const store = useStore();
        const commonMst = computed(() => store.state.common);
		const loadCommonMst = () => {
			let mst_id = [
				"product_type",
				"status_nq",
				"terminal_type",
				"terminal_model",
				"support_country_area",
				"terminal_model_price",
			];
			store.dispatch("common/getCommonMst", mst_id);
		};
		const getProductById = (id) => {
			ServiceAPI.axiosCall("product_detail", { id: id })
				.then((res) => {
					if (!res.error) {
						productDetail.value = res.response;
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
        loadCommonMst();
		getProductById(route.params.id);
		return { utils, commonMst, productDetail };
	},
};
</script>

<style>
</style>