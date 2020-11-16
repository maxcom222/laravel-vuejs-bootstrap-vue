<template>
    <b-card header="Posts">
        <b-button v-b-modal.modal-create class="mb-2" variant="primary">Create Post</b-button>

        <b-modal v-model="create_modal_show" id="modal-create" no-close-on-backdrop content-class="shadow" title="Create Post">
            <b-form @submit.prevent="register" @keydown="form.onKeydown($event)">
                <b-form-group
                    label="Title:"
                    label-for="title">
                    <b-form-input
                        type="text"
                        id="title"
                        name="title"
                        :class="{ 'is-invalid': form.errors.has('title') }"
                        v-model="form.title">
                    </b-form-input>
                    <has-error
                        :form="form"
                        field="title"/>
                </b-form-group>
                <b-form-group
                    label="Author:"
                    label-for="user_id">
                    <v-select
                        id="user_id"
                        name="user_id"
                        v-model="form.user_id"
                        :searchable="true"
                        :clearable="false"
                        :options="authors"
                        :class="{ 'is-invalid': form.errors.has('user_id') }"
                        :reduce="author => author.id"
                        :get-option-label="getOptionLabel">
                    </v-select>
                    <has-error
                        :form="form"
                        field="user_id" />
                </b-form-group>
                <b-form-group
                    label="Description:"
                    label-for="description">
                    <b-form-textarea
                        id="description"
                        name="description"
                        :class="{ 'is-invalid': form.errors.has('description') }"
                        v-model="form.description"
                        rows="3"
                        max-rows="6">
                    </b-form-textarea>
                    <has-error
                        :form="form"
                        field="description" />
                </b-form-group>
            </b-form>
            <template #modal-footer>
                <div class="w-100">
                    <b-button
                        variant="danger"
                        class="float-right"
                        @click="create_modal_show=false">
                        Close
                    </b-button>
                    <b-button
                        type="submit"
                        variant="primary"
                        class="float-right mr-2"
                        @click="create_post()">
                        Save
                    </b-button>
                </div>
            </template>
        </b-modal>
        <b-modal
            v-model="edit_modal_show"
            id="modal-edit"
            no-close-on-backdrop
            content-class="shadow"
            title="Edit Post">
            <b-form
                @submit.prevent="register"
                @keydown="editform.onKeydown($event)">
                <b-form-group
                    label="Title:"
                    label-for="edit_title">
                    <b-form-input
                        type="text"
                        id="edit_title"
                        name="edit_title"
                        :class="{ 'is-invalid': editform.errors.has('title') }"
                        v-model="editform.title">
                    </b-form-input>
                    <has-error
                        :form="editform"
                        field="title" />
                </b-form-group>
                <b-form-group
                    label="Author:"
                    label-for="edit_user_id">
                    <v-select
                        id="edit_user_id"
                        name="edit_user_id"
                        v-model="editform.user_id"
                        :searchable="true"
                        :clearable="false"
                        :options="authors"
                        :class="{ 'is-invalid': editform.errors.has('user_id') }"
                        :reduce="author => author.id"
                        :get-option-label="getOptionLabel">
                    </v-select>
                    <has-error
                        :form="editform"
                        field="user_id" />
                </b-form-group>
                <b-form-group
                    label="Description:"
                    label-for="edit_description">
                    <b-form-textarea
                        id="edit_description"
                        name="edit_description"
                        :class="{ 'is-invalid': editform.errors.has('description') }"
                        v-model="editform.description"
                        rows="3"
                        max-rows="6">
                    </b-form-textarea>
                    <has-error :form="editform" field="description" />
                </b-form-group>
            </b-form>
            <template #modal-footer>
                <div class="w-100">
                    <b-button
                        variant="danger"
                        class="float-right"
                        @click="edit_modal_show=false">
                        Close
                    </b-button>
                    <b-button
                        type="submit"
                        variant="primary"
                        class="float-right mr-2"
                        @click="save_post">
                        Save
                    </b-button>
                </div>
            </template>
        </b-modal>
        <b-table
            striped
            hover
            :items="items"
            :fields="fields">
            <template
                #cell(action)="data" >
                <b-button
                    size="sm"
                    @click="openModal(data.value)"
                    variant="info">
                    Edit
                </b-button>
                <b-button
                    size="sm"
                    @click="deleteItem(data.value)"
                    variant="danger">
                    Delete
                </b-button>
            </template>
        </b-table>
    </b-card>
</template>

<script>
import Form from "vform";

export default {
    middleware: 'auth',
    data() {
        return {
            create_modal_show: false,
            edit_modal_show: false,
            fields: ['title', 'user_name', 'description', 'action'],
            items: [],
            authors: [],
            form: new Form({
                title: '',
                user_id: 0,
                description: ''
            }),
            editform: new Form({
                id: 0,
                title: '',
                user_id: 0,
                description: ''
            })
        }
    },
    methods: {
        getOptionLabel (option) {
            return (option && option.name) || ''
        },
        async loadAuth () {
            const { data } = await this.form.get('/api/users')
            this.authors = data;
        },
        async loadPosts () {
            const { data } = await this.form.get('/api/posts')
            this.items = data;
        },
        openModal(item_id) {
            let item = this.items.find(({id})=>id===item_id)
            this.edit_modal_show = true
            this.editform.id = item.id
            this.editform.title = item.title
            this.editform.user_id = item.user_id
            this.editform.description = item.description
        },
        async create_post() {
            const { data } = await this.form.post('/api/posts')
            if (data.id > 0)
            {
                this.$bvToast.toast('The post was created successfully', {
                    title: `Notification`,
                    variant: 'success',
                    solid: true
                })
                this.create_modal_show = false;
                this.loadPosts();
            } else {
                this.$bvToast.toast('Post creating operation was failed', {
                    title: `Notification`,
                    variant: 'danger',
                    solid: true
                })
            }
        },
        async save_post() {
            const { data } = await this.editform.post('/api/posts/' + this.editform.id)
            if (data.id > 0)
            {
                this.$bvToast.toast('The post was updated successfully', {
                    title: `Notification`,
                    variant: 'success',
                    solid: true
                })
                this.edit_modal_show = false;
                this.loadPosts();
            } else {
                this.$bvToast.toast('Post updating operation was failed', {
                    title: `Notification`,
                    variant: 'danger',
                    solid: true
                })
            }
        },
        async deleteItem(id) {
            const { data } = await this.editform.delete('/api/posts/' + id)
            if (data.status === "success")
            {
                this.$bvToast.toast('The post was deleted successfully', {
                    title: `Notification`,
                    variant: 'success',
                    solid: true
                })
            } else {
                this.$bvToast.toast('Post deleting operation was failed', {
                    title: `Notification`,
                    variant: 'danger',
                    solid: true
                })
            }
            this.loadPosts();
        }
    },
    mounted() {
        this.loadAuth();
        this.loadPosts();
    }
}
</script>
