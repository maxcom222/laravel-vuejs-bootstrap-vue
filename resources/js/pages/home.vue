<template>
    <b-card header="Posts">
        <b-button v-b-modal.modal-create class="mb-2" variant="primary">Create Post</b-button>

        <b-modal v-model="create_modal_show" id="modal-create" no-close-on-backdrop content-class="shadow" title="Create Post">
            <b-form @submit.prevent="register" @keydown="form.onKeydown($event)">
                <b-form-group
                    label="Title:"
                    label-for="title">
                    <b-form-input type="text" id="title" name="title" :class="{ 'is-invalid': form.errors.has('title') }" v-model="form.title"></b-form-input>
                    <has-error :form="form" field="title" />
                </b-form-group>
                <b-form-group
                    label="Author:"
                    label-for="author">
                    <b-form-select id="author" name="author" :class="{ 'is-invalid': form.errors.has('author') }" v-model="form.author" :options="options"></b-form-select>
<!--                    <b-form-input id="user" name="user" :class="{ 'is-invalid': form.errors.has('user') }" v-model="form.user" list="my-list-id"></b-form-input>-->
<!--                    <datalist id="my-list-id">-->
<!--                        <option v-for="option in options">{{ option.text }}</option>-->
<!--                    </datalist>-->
                    <has-error :form="form" field="author" />
                </b-form-group>
                <b-form-group
                    label="Description:"
                    label-for="description">
                    <b-form-textarea id="description" name="description" :class="{ 'is-invalid': form.errors.has('description') }" v-model="form.description" rows="3" max-rows="6"></b-form-textarea>
                    <has-error :form="form" field="description" />
                </b-form-group>
            </b-form>
            <template #modal-footer>
                <div class="w-100">
                    <b-button
                        variant="danger"
                        class="float-right"
                        @click="create_modal_show=false"
                    >
                        Close
                    </b-button>
                    <b-button
                        type="submit"
                        variant="primary"
                        class="float-right mr-2"
                    >
                        Save
                    </b-button>
                </div>
            </template>
        </b-modal>
        <b-modal v-model="edit_modal_show" id="modal-edit" no-close-on-backdrop content-class="shadow" title="Edit Post">
            <b-form @submit.prevent="register" @keydown="editform.onKeydown($event)">
                <b-form-group
                    label="Title:"
                    label-for="title">
                    <b-form-input type="text" id="title" name="title" :class="{ 'is-invalid': editform.errors.has('title') }" v-model="editform.title"></b-form-input>
                    <has-error :form="editform" field="title" />
                </b-form-group>
                <b-form-group
                    label="Author:"
                    label-for="author">
<!--                    <b-form-select id="user" name="user" :class="{ 'is-invalid': editform.errors.has('user') }" v-model="editform.user" :options="options"></b-form-select>-->
                    <b-form-input id="author" name="author" :class="{ 'is-invalid': form.errors.has('author') }" v-model="form.author" list="my-list-id"></b-form-input>
                    <datalist id="my-list-id">
                        <option v-for="option in options">{{ option.text }}</option>
                    </datalist>
                    <has-error :form="editform" field="author" />
                </b-form-group>
                <b-form-group
                    label="Description:"
                    label-for="description">
                    <b-form-textarea id="description" name="description" :class="{ 'is-invalid': editform.errors.has('description') }" v-model="editform.description" rows="3" max-rows="6"></b-form-textarea>
                    <has-error :form="editform" field="description" />
                </b-form-group>
            </b-form>
            <template #modal-footer>
                <div class="w-100">
                    <b-button
                        variant="danger"
                        class="float-right"
                        @click="edit_modal_show=false"
                    >
                        Close
                    </b-button>
                    <b-button
                        type="submit"
                        variant="primary"
                        class="float-right mr-2"
                    >
                        Save
                    </b-button>
                </div>
            </template>
        </b-modal>
        <b-table striped hover :items="items">
            <template #cell(action)="data">
                <b-button size="sm" @click="openModal(data.value)" variant="info">Edit</b-button>
                <b-button size="sm" @click="delete(data.value)" variant="danger">Delete</b-button>
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
            items: [
                { title: 'Title1', author: 'Dickerson', description: 'Macdonald', action: 2 },
                { title: 'Title2', author: 'Larsen', description: 'Shaw', action: 1 },
                { title: 'Title3', author: 'Geneva', description: 'Wilson', action: 3 },
                { title: 'Title4', author: 'Jami', description: 'Carney', action: 4 }
            ],
            options: [
                { value: 'a', text: 'This is First option'},
                { value: 'b', text: 'Selected Option'}
            ],
            form: new Form({
                title: '',
                author: "a",
                description: ''
            }),
            editform: new Form({
                id: '',
                title: '',
                author: "Geneva",
                description: ''
            })
        }
    },
    methods: {
        openModal(id) {
            this.edit_modal_show = true
            this.editform.id = "Title3"
            this.editform.title = "Title3"
            this.editform.author = "Geneva"
            this.editform.description = "Wilson"
        },
        delete(id) {

        }
    }
}
</script>
