<template>
    <b-row>
        <b-col md="4"></b-col>
        <b-col md="4">
            <b-form @submit="onSubmit">
                <b-form-group :label="$t('lang.auth.form.label')">
                    <b-form-input
                    type="password"
                    v-model="form.password"
                    :placeholder="flag ? '' : this.$t('lang.auth.form.placeholder')">
                </b-form-input>
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
                this.api.get(this.$store.state.config.api, {
                    browser: '',
                    token: this.$route.params.keyword + ',' + this.form.password,
                }).then(response => {
                    if (response.status === 200) {
                        this.$parent.content = response.content;
                        this.$parent.type = response.type;
                        this.$parent.view = 'paste_view';
                    } else {
                        this.flag = false;
                        this.form.password = null;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
