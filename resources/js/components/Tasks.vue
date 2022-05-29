<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Task List</h3>

                <div class="card-tools">

                  <button type="button" class="btn btn-sm btn-primary" @click="newModal">
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
                     <tr v-for="task in getAllTasks" :key="task.id">

                      <td>{{task.id}}</td>
                      <td>{{task.description | truncate(task, 30, '...')}}</td>
                      <td>{{task.status}}</td>
                      <!-- <td><img v-bind:src="'/' + task.photo" width="100" alt="task"></td> -->
                      <td>

                        <a href="#" @click="editModal(task)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteTask(task.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="tasks" @pagination-change-page="getAllTasks"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Create New Product</h5>
                    <h5 class="modal-title" v-show="editmode">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="editmode ? updateTask() : createTask()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Description</label>
                            <input v-model="form.description" type="text" name="description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                            <has-error :form="form" field="description"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select v-model="form.status"  name="status"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                                <option value="">Select</option>
                                <option value="New">New</option>
                                <option value="InProgress">InProgress</option>
                                <option value="Complete">Complete</option>
                                <option value="Closed">Closed</option>
                            </select>
                            <has-error :form="form" field="status"></has-error>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
  </section>
</template>

<script>
import mapActions  from 'vuex';
    export default {

        name: 'Tasks',
        mounted() {
          this.fetchTasks()
        },
        computed: {
                getAllTasks(){ //final output from here
                    return this.$store.getters.tasks
                }
        },
        methods: {
            fetchTasks () {
                this.$store.dispatch('fetchTasks')
            }
        },
        filters: {
            truncate: function (text, length, suffix) {
                console.log(text)
                return text.substring(0, length) + suffix;
            },
        },

    }
</script>
