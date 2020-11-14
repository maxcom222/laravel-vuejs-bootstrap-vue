<template>
  <card :title="'Home'">
      You are logged in
  </card>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: 'Home' }
  }
}
</script>
