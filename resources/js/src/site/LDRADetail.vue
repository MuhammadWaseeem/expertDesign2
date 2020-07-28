<template>
</template>

<script>
    export default {

        data() {
            return {
                id: this.$route.params.id,
                DbData: {}
            }
        },
        methods: {
            Get() {
                // Loading
                this.$vs.loading()
                this.$http.get('/risk-assessment/' + this.id)
                    .then(response => {
                        if (response.data.status) {
                            this.DbData = response.data.data;
                        } else {
                            this.$vs.notify({
                                title: 'Error',
                                text: response.data.msg,
                                iconPack: 'feather',
                                icon: 'icon-alert-circle',
                                color: 'danger'
                            });
                            this.$router.push('/risk-assessment/history');
                        }
                        this.$vs.loading.close();
                    })
                    .catch(error => {
                        this.$vs.loading.close();
                    });
            },
        },
        created() {
            this.Get();

        }
    }
</script>
