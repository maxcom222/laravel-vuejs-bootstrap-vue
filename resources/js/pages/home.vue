<template>
    <b-card header="Home">
        You are logged in
    </b-card>
</template>

<script>
export default {
  middleware: 'auth',
}
</script>
