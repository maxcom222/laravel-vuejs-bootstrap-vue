<template>
    <div class="row">
        <div class="col-lg-8 m-auto">
            <b-card header="Create User">
                <b-form @submit.prevent="create" @keydown="form.onKeydown($event)">
                    <b-form-group
                        label="Name:"
                        label-for="name">
                        <b-form-input type="text" id="name" name="name" :class="{ 'is-invalid': form.errors.has('name') }" v-model="form.name"></b-form-input>
                        <has-error :form="form" field="name" />
                    </b-form-group>
                    <b-form-group
                        label="Hobbies:"
                        label-for="hobbies">
                        <v-select
                            id="hobbies"
                            v-model="form.hobbies"
                            :searchable="true"
                            :clearable="false"
                            :multiple="true"
                            :options="hobbies"
                            :class="{ 'is-invalid': form.errors.has('hobbies') }"
                            :reduce="hobbie => hobbie.value"
                            label="text">
                        </v-select>
                        <has-error :form="form" field="hobbies" />
                    </b-form-group>
                    <b-form-group
                        label="Email:"
                        label-for="email" >
                        <b-form-input type="email" id="email" name="email" :class="{ 'is-invalid': form.errors.has('email') }" v-model="form.email"></b-form-input>
                        <has-error :form="form" field="email" />
                    </b-form-group>
                    <b-form-group
                        label="Phone:"
                        label-for="phone">
                        <b-form-input :number="true" :formatter="formatPhone" type="text" id="phone" name="phone" :class="{ 'is-invalid': form.errors.has('phone') }" v-model="form.phone"></b-form-input>
                        <has-error :form="form" field="phone" />
                    </b-form-group>
                    <b-form-group
                        label="Country:"
                        label-for="countries">
                        <b-form-select id="countries" name="country_id" value-field="id" text-field="name" :class="{ 'is-invalid': form.errors.has('country_id') }" v-model="form.country_id" :options="countries"></b-form-select>
                        <has-error :form="form" field="country_id" />
                    </b-form-group>
                    <b-form-group
                        label="Password:"
                        label-for="password" >
                        <b-form-input type="password" id="password" name="password" :class="{ 'is-invalid': form.errors.has('password') }" v-model="form.password"></b-form-input>
                        <has-error :form="form" field="password" />
                    </b-form-group>
                    <b-button type="submit" variant="primary">save</b-button>
                </b-form>
            </b-card>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import Form from 'vform'

export default {
    components: {},

    middleware: 'auth',

    data: () => ({
        form: new Form({
            name: '',
            hobbies: [],
            email: '',
            phone: '',
            country_id: 1,
            password: ''
        }),
        hobbies: [
            { value: 'Soccer', text: 'Soccer'},
            { value: 'Game', text: 'Game'},
            { value: 'Watching', text: 'Watching'}
        ],
        countries: []
    }),

    methods: {
        async create () {
            const { data } = await this.form.post('/api/users')
            this.$router.push({ name: 'users' })
        },
        async loadCountries () {
            const { data } = await axios.get('/api/countries')
            this.countries = data.data;
        },
        formatPhone(e){
            return String(e).substring(0,10);
        }
    },
    mounted() {
        this.loadCountries()
    }
}
</script>
