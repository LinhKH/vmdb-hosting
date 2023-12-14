const listApi = {
    csrfToken: { method: 'GET', url: 'sanctum/csrf-cookie' },
    //Auth
    login: { method: 'POST', url: 'api/auth/login' },
    logout: { method: 'POST', url: 'api/auth/logout' },
    forgot: { method: 'POST', url: 'api/auth/forgot' },
    reset_password: { method: 'POST', url: 'api/auth/reset_password' },
    user_info: { method: 'GET', url: 'api/user' },
    common_master: { method: 'POST', url: 'api/commonmst' },
    search_condition: { method: 'GET', url: 'api/search_condition' },
    support_country_master_list: { method: 'POST', url: 'api/support_country_master_list' },
    support_country_group_list: { method: 'POST', url: 'api/support_country_group_list' },
    support_country_search: { method: 'POST', url: 'api/support_country_search' },
    support_country_detail: { method: 'GET', url: 'api/support_country_detail' },
    support_country_group_search: { method: 'POST', url: 'api/support_country_group_search' },
    support_country_group_detail: { method: 'GET', url: 'api/support_country_group_detail' },
    // product list
    product_list: { method: 'POST', url: 'api/product_list_search' },
    support_country_data: { method: 'POST', url: 'api/support_country_data' },
    product_detail: { method: 'GET', url: 'api/product_detail' },
    // terminal
    admin_data: { method: 'POST', url: 'api/admin_data' },
    terminal_list_search: { method: 'POST', url: 'api/terminal_list_search' },
    terminal_detail: { method: 'GET', url: 'api/terminal_detail' },
    // option list
    option_list: { method: 'POST', url: 'api/option_list_search' },
    option_detail: { method: 'GET', url: 'api/option_detail' },
    option_detail_by_id: { method: 'GET', url: 'api/option_detail_by_id' },
    // option from list
    option_from_list: { method: 'POST', url: 'api/option_from_list_search' },
    option_from_detail: { method: 'GET', url: 'api/option_from_detail' },
    //place
    location_master_data: { method: 'POST', url: 'api/location_master_data' },
    place_master_data: { method: 'POST', url: 'api/place_master_data' },
    place_list_search: { method: 'POST', url: 'api/place_list_search' },
    place_detail:  { method: 'GET', url: 'api/place_detail' },
    //option_plan
    option_plan_list_search: { method: 'POST', url: 'api/option_plan_list_search' },
    option_plan_detail: { method: 'GET', url: 'api/option_plan_detail' },

}

export default listApi