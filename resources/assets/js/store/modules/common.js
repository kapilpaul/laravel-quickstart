export const commonStore = {
  state: {
    validationErrors: [],
    submitted: false,
    items: [],
    page: 1,
    pageCount: 2,
    token: null
  },
  getters: {
    validationErrors: state => {
      return state.validationErrors;
    },
    submitted: state => {
      return state.submitted;
    },
    items: state => {
      return state.items;
    },
    page: state => {
      return state.page;
    },
    pageCount: state => {
      return state.pageCount;
    },
    getHeader: state => {
      return getHeader();
    }
  },
  mutations: {
    setValidationErrors: (state, payload) => {
      state.validationErrors = payload;
    },
    setSubmitted: (state, payload) => {
      state.submitted = payload;
    },
    setItems: (state, payload) => {
      state.items = payload;
    },
    setPage: (state, payload) => {
      state.page = payload;
    },
    setPageCount: (state, payload) => {
      state.pageCount = payload;
    }
  },
  actions: {
    setValidationErrors: ({
      commit
    }, payload) => {
      commit("setValidationErrors", payload);
    },
    setSubmitted: ({
      commit
    }, payload) => {
      commit("setSubmitted", payload);
    },
    setItems: ({
      commit
    }, payload) => {
      if (typeof payload.url !== 'undefined') {
        axios.get(payload.url, getHeader()).then(response => {
          commit("setItems", response.data);
        });
      } else {
        commit("setItems", payload);
      }
    },
    setPage: ({
      commit
    }, payload) => {
      commit("setPage", payload);
    },
    setPageCount: ({
      commit
    }, payload) => {
      commit("setPageCount", payload);
    }
  }
};

const getToken = () => {
  var token = localStorage.getItem("token");
  var expiration = localStorage.getItem("expiration");

  if (!token || !expiration) return null;

  if (Date.now() > parseInt(expiration)) {
    destroyToken();
    return null;
  } else {
    return token;
  }
};

const getHeader = () => {
  const tokenData = getToken();
  return {
    headers: {
      Accept: "application/json",
      Authorization: "Bearer " + tokenData
    }
  };
};

const destroyToken = () => {
  localStorage.removeItem("token");
  localStorage.removeItem("expiration");
};