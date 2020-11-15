<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <div id="navbarToggler" class="collapse navbar-collapse">
                <b-nav pills>
                    <b-nav-item v-if="user" @click.prevent="logout">
                        <b-link :to="{ name: 'login' }">
                            Log Out
                        </b-link>
                    </b-nav-item>
                    <template v-else>
                        <b-nav-item>
                            <b-link :to="{ name: 'login' }">
                                Log In
                            </b-link>
                        </b-nav-item>
                        <b-nav-item>
                            <b-link :to="{ name: 'register' }">
                                Register
                            </b-link>
                        </b-nav-item>
                    </template>
                </b-nav>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    components: {},

    data: () => ({
        appName: window.config.appName
    }),

    computed: mapGetters({
        user: 'auth/user'
    }),

    methods: {
        async logout () {
            await this.$store.dispatch('auth/logout')
            this.$router.push({ name: 'login' })
        }
    }
}
</script>

<style scoped>
.profile-photo {
width: 2rem;
height: 2rem;
margin: -.375rem 0;
}
</style>
