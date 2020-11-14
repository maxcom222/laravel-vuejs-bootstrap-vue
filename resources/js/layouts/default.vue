<template>
  <div class="main-layout">
    <navbar />

    <div class="container mt-4">
      <child />
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
import Child from '~/components/Child'

export default {
    name: 'MainLayout',

    components: {
        Navbar,
        Child
    }
}
</script>
