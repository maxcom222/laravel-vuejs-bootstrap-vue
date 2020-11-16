<template>
    <b-navbar v-if="user" type="light" variant="light">
        <div class="container">
            <b-navbar-nav class="ml-2">
                <b-nav-item>
                    <b-link :to="{name: 'users'}">
                        Users
                    </b-link>
                </b-nav-item>
                <b-nav-item>
                    <b-link :to="{name: 'posts'}">
                        Posts
                    </b-link>
                </b-nav-item>
            </b-navbar-nav>
            <b-navbar-nav>
                <b-nav-item @click.prevent="logout" right>
                    <b-link>
                        Log Out
                    </b-link>
                </b-nav-item>
            </b-navbar-nav>
        </div>
    </b-navbar>
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
