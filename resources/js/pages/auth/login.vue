<template>
    <div class="row">
        <div class="col-lg-8 m-auto">
            <b-card header="Log In">
                <b-form @submit.prevent="login" @keydown="form.onKeydown($event)">
                    <b-form-group
                        label="Email:"
                        label-for="email" >
                        <b-form-input type="email" id="email" name="email" :class="{ 'is-invalid': form.errors.has('email') }" v-model="form.email"></b-form-input>
                        <has-error :form="form" field="email" />
                    </b-form-group>
                    <b-form-group
                        label="Password:"
                        label-for="password" >
                        <b-form-input type="password" id="password" name="password" :class="{ 'is-invalid': form.errors.has('password') }" v-model="form.password"></b-form-input>
                        <has-error :form="form" field="password" />
                    </b-form-group>
                    <b-button type="submit" variant="primary">Log In</b-button>
                </b-form>
            </b-card>
        </div>
    </div>
</template>

<script>
import Form from 'vform'

export default {
  components: {
  },

  middleware: 'guest',

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      const { data } = await this.form.post('/api/login')

      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      await this.$store.dispatch('auth/fetchUser')

      this.redirect()
    },

    redirect () {
        this.$router.push({ name: 'posts' })
    }
  }
}
</script>
