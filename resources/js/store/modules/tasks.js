import axios from 'axios';

const state = {
    tasks: []
};

const getters = {
    tasks: state => state.tasks
};

const actions = {
    async fetchTasks({ commit }) {
        const response =  await axios.get(
            'api/task'
        )
        commit('setTasks', response.data.data);
    },
    async addTask({ commit }, payload) {
        const response = await axios.post(
            'api/task',
            { payload }
        );

        commit('newTask', response.data);
    },
    async deleteTask({ commit }, id) {
        await axios.delete(`api/task/${id}`);

        commit('removeTask', id);
    },
    async filterTask({ commit }, e) {
        // Get selected number
        const limit = parseInt(
            e.target.options[e.target.options.selectedIndex].innerText
        );

        const response = await axios.get(
            `api/task?_limit=${limit}`
        );

        commit('setTask', response.data);
    },
    async updateTask({ commit }, updTask) {
        const response = await axios.put(
            `api/Task/${updTask.id}`,
            updTask
        );

        console.log(response.data);

        commit('updateTask', response.data);
    }
};

const mutations = {
    setTasks: (state, tasks) => (state.tasks = tasks),
    newTask: (state, task) => state.tasks.unshift(task),
    removeTask: (state, id) =>
        (state.tasks = state.tasks.filter(task => task.id !== id)),
    updateTask: (state, updTask) => {
        const index = state.tasks.findIndex(task => task.id === updTask.id);
        if (index !== -1) {
            state.tasks.splice(index, 1, updTask);
        }
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
