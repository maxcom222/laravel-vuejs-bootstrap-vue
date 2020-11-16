<script>

export default {
    methods: {
        $show_message (title, message, variant) {
            this.$bvToast.toast(message, {
                title: title,
                variant: variant,
                solid: true
            })
        }
    }
}
</script>
