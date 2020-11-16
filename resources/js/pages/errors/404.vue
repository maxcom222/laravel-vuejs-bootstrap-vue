<template>
    <b-card class="text-center">
        <h3 class="mb-4">
            Page Not Found
        </h3>
        <div class="links">
            <router-link :to="{ name: 'posts' }">
                Go Home
            </router-link>
        </div>
    </b-card>
</template>

<script>
export default {
  name: 'NotFound'
}
</script>
