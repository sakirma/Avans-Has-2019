const store = new Vuex.Store({
    state: {
        pageState: {"startPage": 1, "mapPage": 2, "projectPage": 3,},
        currentPageState: 1, //StartPage
    },
    getters: {
      pagesState: state => { return state.pageState; }
    },
    mutations: {
        increment (pageState) {
            this.currentPageState = pageState;
        }
    }
})
