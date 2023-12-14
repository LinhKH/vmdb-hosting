export default {
    namespaced: true,
  
    state: () => ({
      isLoading: false,
      stackLoading:[],
    }),
    mutations: {
      setLoading(state, val) {
        if(val){
          state.stackLoading.push('1');
        }else{
          state.stackLoading.pop()
        }
        state.isLoading = state.stackLoading.length != 0;
      },
    },
  };