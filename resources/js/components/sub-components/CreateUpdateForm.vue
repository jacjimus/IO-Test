

<script>
export default {
    name: "CreateUpdateForm",
    props: {
      'editing',
    }
}
</script>

<style scoped>

</style>

<template>
    <div v-if="showModal" class="modal fade" style="opacity:1;display:block" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editing">Create New Product</h5>
                    <h5 class="modal-title" v-show="editing">Edit Product</h5>
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
                        <button v-show="!editing" type="submit" @click="handleStore" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
