<template>
  <div id="tab-2" class="tabcontent" style="display: block;">
              <div class="page-title-top">
                <p>対応国一覧</p>
              </div>
              <div class="block-content-wrapper">
                <div class="block-content">
                  <div class="block-group-search">
                    <div class="search-row">
                      <div class="field-search field-1p6">
                        <label for="f001" class="label-control">ID</label>
                        <div class="field-search-input">
                          <input type="text" class="form-control" name="id" id="f001" v-model="search.id">
                        </div>
                      </div>
                      <div class="field-search field-0p7">
                        <label for="f002" class="label-control">タイプ	</label>
                        <div class="field-search-input">
                          <select id="f002" class="form-control" name="item_type" v-model="search.item_type">
                            <option value="">選択</option>
                            <option v-for="(value, key) in commonMst.support_country_item" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="field-search field-1p6">
                        <label for="f003" class="label-control label-xl-small-device">エリア</label>
                        <div class="field-search-input">
                          <select id="f003" class="form-control" name="area_no" v-model="search.area_no">
                            <option value="">選択</option>
                            <option v-for="(value, key) in commonMst.support_country_area" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="field-search field-0p7">
                        <label for="f004" class="label-control">国名</label>
                        <div class="field-search-input">
                          <input type="text" class="form-control" name="name" id="f004" v-model="search.name">
                        </div>
                      </div>
                      <div class="field-search field-0p7">
                        <label for="f005" class="label-control">日数制限</label>
                        <div class="field-search-input">
                          <input type="text" class="form-control" name="rental_days_max" id="f005" v-model="search.rental_days_max">
                          <span>&nbsp;回&nbsp;</span>
                        </div>
                      </div>
                      <div class="field-search field-0p7">
                        <label for="f006" class="label-control">申込制限</label>
                        <div class="field-search-input">
                          <select id="f006" class="form-control" name="stop_yn" v-model="search.stop_yn">
                            <option value="">選択</option>
                            <option v-for="(value, key) in commonMst.support_country_stop_yn" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="search-row">
                      <div class="field-search field-1p6">
                        <label for="f007" class="label-control">SIM</label>
                        <div class="field-search-input">
                          <select id="f007" class="form-control" name="sim_type" v-model="search.sim_type">
                            <option value="">選択</option>
                            <option v-for="(value, key) in commonMst.support_country_sim_type" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="field-search field-0p7">
                        <label for="f008" class="label-control">超直前</label>
                        <div class="field-search-input">
                          <select id="f008" class="form-control" name="just_before_status" v-model="search.just_before_status">
                            <option value="">選択</option>
                            <option v-for="(value, key) in commonMst.order_just_before_yn" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="field-search field-1p6">
                        <label for="f009" class="label-control label-xl-small-device">URL文字列	</label>
                        <div class="field-search-input">
                          <input type="text" class="form-control" name="site_code" id="f009" v-model="search.site_code">
                        </div>
                      </div>
                      <div class="field-search field-0p7">
                        <label for="f0010" class="label-control">申込プル</label>
                        <div class="field-search-input">
                          <select id="f0010" class="form-control" name="site_order_flag" v-model="search.site_order_flag">
                            <option value="">選択</option>
                            <option v-for="(value, key) in commonMst.display_yn" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="field-search field-0p7">
                        <label for="f0011" class="label-control">詳細</label>
                        <div class="field-search-input">
                          <select id="f0011" class="form-control" name="site_detail_flag" v-model="search.site_detail_flag">
                            <option value="">選択</option>
                            <option v-for="(value, key) in commonMst.display_yn" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="field-search field-0p7">
                        <label for="f0012" class="label-control">一覧</label>
                        <div class="field-search-input">
                          <select id="f0012" class="form-control" name="site_list_flag" v-model="search.site_list_flag">
                            <option value="">選択</option>
                            <option v-for="(value, key) in commonMst.display_yn" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="field-search">
                        <label for="f0013" class="label-control label-xl-small-device">管理申込プル</label>
                        <div class="field-search-input">
                          <select id="f0013" class="form-control" name="admin_order_flag" v-model="search.admin_order_flag">
                            <option value="">選択</option>
                            <option v-for="(value, key) in commonMst.display_yn" :key="key"  :value="value.code_value">{{value.disp_value}}</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="search-row justify-content-between">
                      <div class="field-search field-1p6">
                        <label for="f0014" class="label-control">国マスタ</label>
                        <div class="field-search-input">
                          <select id="f0014" class="form-control" name="master_id" v-model="search.master_id">
                            <option value="">選択</option>
                            <option v-for="item in support_country_list" :key="item.id"  :value="item.id">{{item.name}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="field-search">
                        <div class="field-search-input justify-content-center">
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
                      <table class="table table-bordered table-fixed block-scroll-x">
                        <colgroup>
                          <col style="width: 70px;">
                          <col style="width: 70px;">
                          <col style="width: 150px;">
                          <col style="width: 100px;">
                          <col style="width: 220px;">
                          <col style="width: 80px;">
                          <col style="width: 100px;">
                          <col style="width: 80px;">
                          <col style="width: 60px;">
                          <col style="width: 100px;">
                          <col style="width: 180px;">
                          <col style="width: 75px;">
                          <col style="width: 75px;">
                          <col style="width: 75px;">
                          <col style="width: 75px;">
                          <col style="width: 100px;">
                          <col style="width: 170px;">
                          <col style="width: 80px;">
                        </colgroup>
                        <thead>
                          <tr class="bg-gray text-center">
                            <td rowspan="2">ID</td>
                            <td rowspan="2">タイプ</td>
                            <td rowspan="2">エリア</td>
                            <td rowspan="2">国マスタ	</td>
                            <td rowspan="2">国名</td>
                            <td rowspan="2">日数制限</td>
                            <td rowspan="2">日数制限<br>（現地受取）</td>
                            <td rowspan="2">申込制限</td>
                            <td rowspan="2">SIM</td>
                            <td rowspan="2">超直前</td>
                            <td colspan="5">サイト制御</td>
                            <td rowspan="2">管理申込プル</td>
                            <td rowspan="2">登録日時	</td>
                            <td rowspan="2">詳細</td>
                          </tr>
                          <tr class="bg-gray text-center">
                            <td>URL文字列</td>
                            <td>申込プル	</td>
                            <td>一覧</td>
                            <td>詳細</td>
                            <td>料金</td>
                          </tr>
                        </thead>
                        <tbody>

                          <tr v-for="row in search_result.data" :key="row.id">
                            <td class="text-right">{{row.id}}</td>
                            <td class="text-center"><CommonMst :mstNm="`support_country_item`" v-model="row.item_type"></CommonMst></td>
                            <td class="text-center"><CommonMst :mstNm="`support_country_area`" v-model="row.area_no"></CommonMst></td>
                            <td class="text-center">{{getSupportCountryMaster(row.master_id)}}</td>
                            <td class="">{{row.name ? row.name : '国不明'}}</td>
                            <td class="text-center"><ThousandsSeparator :suffix="`日`" :number="row.rental_days_max"/></td>
                            <td class="text-center"><ThousandsSeparator :suffix="`日`" :number="row.rental_days_max_loc_out"/></td>
                            <td class="text-center"><CommonMst :mstNm="`support_country_stop_yn`" v-model="row.stop_yn"></CommonMst></td>
                            <td class="text-center">{{row.sim_type}}</td>
                            <td class="text-center"><CommonMst :mstNm="`order_just_before_yn`" v-model="row.just_before_status"></CommonMst></td>
                            <td class="">{{row.site_code}}</td>
                            <td class="text-center"><CommonMst :mstNm="`display_yn`" v-model="row.site_order_flag"></CommonMst></td>
                            <td class="text-center"><CommonMst :mstNm="`display_yn`" v-model="row.site_list_flag"></CommonMst></td>
                            <td class="text-center"><CommonMst :mstNm="`display_yn`" v-model="row.site_detail_flag"></CommonMst></td>
                            <td class="text-center"><CommonMst :mstNm="`display_yn`" v-model="row.site_price_flag"></CommonMst></td>
                            <td class="text-center"><CommonMst :mstNm="`display_yn`" v-model="row.admin_order_flag"></CommonMst></td>
                            <td class="text-center">{{utils.formatDateTime(row.reg_dt)}}</td>
                            <td class="text-center">
                                <router-link :to="{name: 'support_country_detail', params:{id: row.id}}" class="btn btn-primary" title="詳細">詳細</router-link>
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
import NavBar from '@/components/partials/SecondNav.vue';
import ThousandsSeparator from "@/components/partials/ThousandsSeparator.vue"
import PaginationBase from "@/components/plugins/PaginationBase.vue";
import CommonMst from "@/components/partials/CommonMst.vue"
import { computed, ref } from "vue";
import { useStore } from 'vuex'
import ServiceAPI from "@/service/api";
import utils from '@/service/utils';


export default {
    components: { NavBar, ThousandsSeparator, PaginationBase, CommonMst },
    setup(){
        let total_items = ref(0) 
        let current_page = ref(1);
        let items_per_page = ref(15);
        const search_result = ref({});
        let default_search = {
            order_by: '-reg_dt',
            per_page: items_per_page.value,
            page: 1,
            item_type:"",
            area_no:"",
            stop_yn:"",
            sim_type:"",
            just_before_status:"",
            site_order_flag:"",
            site_detail_flag:"",
            site_list_flag:"",
            admin_order_flag:"",
            master_id:"",
            screen_nm: "support_country_list",
        };
        const list_sort = [
            { value :'+reg_dt', text: '登録日古順'},
            { value :'-reg_dt', text: '登録日新順' },
            { value :'+area_no', text: 'エリア順'},
            { value :'-area_no', text: 'エリア逆順'},
            { value :'+order_no', text: '表示順'},
            { value :'-order_no', text: '表示逆順'},
        ]
        const support_country_list = ref([])
        const search = ref(Object.assign({}, default_search));
        const store = useStore()
        const commonMst = computed(() => store.state.common);
        const loadCommonMst = () => {
            let mst_id = ['support_country_area','support_country_item','order_just_before_yn','support_country_sim_type','display_yn','valid_yn','support_country_stop_yn'];
            store.dispatch("common/getCommonMst", mst_id);
        }

        const supportCountryMasterList = ()=>{
            ServiceAPI.axiosCall("support_country_master_list", {})
                .then((res) => {
                    if(!res.error){
                        support_country_list.value = res.response
                    }
            })
            .catch((err) => {
                console.log(err);
            });
        }

        const supportCountrySearch = ()=>{
            search.value.page = current_page.value;
            search.value.per_page = items_per_page.value;
            ServiceAPI.axiosCall("support_country_search", search.value)
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
          supportCountrySearch();
        }

        const handleSearch = ()=>{
          search.value.btn = "search";
          current_page.value = default_search.page;
          supportCountrySearch();
        }
        
        const getSupportCountryMaster = (master_id)=>{
            let countryMaster = _.find(support_country_list.value, {id: master_id});
            return countryMaster? countryMaster.name : '';
        }

        const onPageChange = ()=>{
          search.value.btn = "";
          supportCountrySearch();
        }


        const searchCondition = ()=>{
          ServiceAPI.axiosCall("search_condition", {screen_nm: 'support_country_list'})
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
                      supportCountrySearch();
                }
            })
            .catch((err) => {
                console.log(err);
            });
        }

        loadCommonMst();
        supportCountryMasterList();
        searchCondition();

        return {
          utils,commonMst, search, support_country_list, clearSearch, 
          handleSearch, list_sort, search_result, getSupportCountryMaster, current_page, 
          items_per_page, onPageChange, total_items
        };

    }
  
};
</script>

<style>
</style>