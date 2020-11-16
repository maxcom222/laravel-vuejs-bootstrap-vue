<template>
    <b-card header="Users">
        <b-button variant="primary" :to="{ name: 'create_user' }" class="mb-2">
            Create User
        </b-button>
        <b-table
            striped
            hover
            :items="items"
            :fields="fields">
            <template
                #cell(action)="data" >
                <b-button
                    size="sm"
                    :to="{ name: 'edit_user', params: { user_id: data.value } }"
                    variant="info">
                    Edit
                </b-button>
                <b-button
                    size="sm"
                    @click="deleteUser(data.value)"
                    variant="danger">
                    Delete
                </b-button>
            </template>
            <template
                #cell(country)="data" >
                {{ data.value.name }}
            </template>
            <template
                #cell(hobbies)="data" >
                {{ Array.isArray(data.value) ? data.value.join(' ') : data.value }}
            </template>
        </b-table>
    </b-card>
</template>

<script>
import axios from 'axios'
import toast from '../../mixins/message'
import { mapGetters } from 'vuex'
export default {
    mixins: [toast],
    middleware: 'auth',
    data() {
        return {
            fields: ['firstname', 'lastname', 'email', 'country', 'hobbies', 'phone', 'action'],
            countries: [],
            items: []
        }
    },
    computed: mapGetters({
        user: 'auth/user'
    }),
    methods: {
        async loadUsers () {
            const { data } = await axios.get('/api/users')
            this.items = data.data;
        },
        async deleteUser(id) {
            if (this.user.id == id)
            {
                this.$show_message(`Notification`, 'You can\'t delete this user', 'danger');
                return;
            }
            const { data } = await axios.delete('/api/users/' + id)
            if (data.status === "success")
            {
                this.$show_message(`Notification`, 'The user was deleted successfully', 'success');
            } else {
                this.$show_message(`Notification`, 'User deleting operation was failed', 'danger');
            }
            this.loadUsers();
        }
    },
    mounted() {
        this.loadUsers();
    }
}
</script>
