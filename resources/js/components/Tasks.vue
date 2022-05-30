<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Task List</h3>

                <div class="card-tools">

                  <button type="button" class="btn btn-sm btn-primary" @click="handleCreate">
                      <i class="fa fa-plus-square"></i>
                      Add New
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="task in tasks.data" :key="task.id">

                      <td>{{task.id}}</td>
                      <td>{{task.description | truncate(30, '...')}}</td>
                      <td>{{task.status}}</td>
                      <!-- <td><img v-bind:src="'/' + task.photo" width="100" alt="task"></td> -->
                      <td>
                      <a href="#" @click="() => handleView(task)">
                          <i class="fa fa-eye green"></i>
                      </a>
                         /
                        <a href="#" @click="() => handleEdit(task)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="() => handleDelete(task)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="tasks" @pagination-change-page="changePage"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="modal fade" style="opacity:1;display:block" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editing">Create New Task</h5>
                    <h5 class="modal-title" v-show="editing">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="persist">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Description</label>
                            <input v-model="selected.description" type="text" name="description"
                                class="form-control" :class="{ 'is-invalid': selected.errors.has('description') }">
                            <has-error :form="selected" field="description"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select v-model="selected.status"  name="status"
                                class="form-control" :class="{ 'is-invalid': selected.errors.has('status') }">
                                <option value="">Select</option>
                                <option value="New">New</option>
                                <option value="InProgress">InProgress</option>
                                <option value="Complete">Complete</option>
                                <option value="Closed">Closed</option>
                            </select>
                            <has-error :form="selected" field="status"></has-error>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="showModal = false">Close</button>
                        <button v-show="editing" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editing" type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>

        <div v-if="viewModal" class="modal fade" style="opacity:1;display:block" id="viewTask" tabindex="-1" role="dialog" aria-labelledby="viewTask" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >View Task details</h5>
                        <button type="button" class="close" @click="viewModal = false" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                        <div class="modal-body">
                           <div class="row">
                               <div class="col-md-4">Task description</div>
                               <div class="col-md-8">{{ this.selected.description }} </div>
                           </div>
                            <div class="row">
                                <div class="col-md-4">Task Status</div>
                                <div class="col-md-8">{{ this.selected.status }}</div>
                            </div>

                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="viewModal = false">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
  </section>
</template>

<script>
import Form from 'vform'
import {mapActions, mapState}  from 'vuex';
export default {
  name: 'Tasks',
  data() {
    return {
      showModal: false,
      viewModal: false,
      selected: new Form({
        description: '',
        status: ''
      })
    };
  },
  mounted() {
    this.fetchTasks();
  },
  computed: {
    ...mapState({
      tasks: state => state.tasks.tasks,
    }),
    editing() {
      return !!this.selected.id;
    }
  },
  methods: {
    ...mapActions(['fetchTasks', 'addTask', 'updateTask', 'deleteTask']),
    resetSelected() {
      this.selected.description = '';
      this.selected.status = '';
    },
    persist() {
      if (this.editing) {
        this.updateTask(this.selected)
        return;
      }

        this.addTask( this.selected)
    },
    handleCreate() {
      this.resetSelected();
      this.showModal = true;
    },
    handleView(task) {
          this.selected =  task ;
          this.viewModal = true;
      },
    handleEdit(task) {
      this.selected = new Form({ ...task });
      this.showModal = true;
    },
    handleDelete(task) {
      this.deleteTask(task.id);
    },
    changePage(page) {
      this.fetchTasks({ page })
    },
  },
  filters: {
      truncate: function (text, length, suffix) {
          return text ? text.substring(0, length) + suffix : '';
      },
  },

}
</script>
