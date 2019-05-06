<template>
    <b-row>
        <b-col md="4"></b-col>
        <b-col md="4">
            <b-form @submit="onSubmit">
                <b-form-group :label="$t('lang.auth.form.label')">
                    <b-form-input v-model="form.password" :placeholder="flag ? '' : this.$t('lang.auth.form.placeholder')"></b-form-input>
                </b-form-group>
                <b-button type="submit" variant="primary">{{ $t('lang.auth.form.button') }}</b-button>
            </b-form>
        </b-col>
    </b-row>
</template>

<script>
    export default {
        name: "PasswordAuth",
        data() {
            return {
                flag: true,
                form: {
                    password: null,
                }
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault();
                this.axios.get(this.pasteme.config.api + 'get.php?browser=&token=' +
                    this.$route.params.keyword + ',' + this.form.password).then(response => {
                    if (response.data.status === 200) {
                        this.$parent.content = response.data.content;
                        this.$parent.type = response.data.type;
                        this.$parent.view = 'paste_view';
                    } else {
                        this.flag = false;
                        this.form.password = null;
                    }
                }).catch(error => {
                    console.log(JSON.stringify(error));
                    alert(this.$t('lang.error.text'));
                });
            }
        }
    }
</script>

<style scoped>

</style>