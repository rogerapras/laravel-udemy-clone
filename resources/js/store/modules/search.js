
// state
export const state = () => {
    return {
        courses: [],
        loading: true
    }
}

// getters
export const getters = {
    courses: state => state.courses,
    loading: state => state.loading
}

// mutations
export const mutations = {
  SET_COURSES (state, data) {
    state.courses = data
  },
  
  SET_LOADING(state, data){
      state.loading = data
  }
}

// actions
export const actions = {
    async fetchCourses ({ commit }, form) {
        const { data } = await form.post('/api/search')
        await commit('SET_COURSES', data.data)
        await commit('SET_LOADING', false)
    }
  
}
