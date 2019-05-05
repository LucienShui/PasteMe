<template>
    <b-row>
        <b-col md="4"></b-col>
        <b-col md="4">
            <b-form @submit="onSubmit">
                <b-form-group label="此 Paste 已加密，请输入密码：">
                    <b-form-input v-model="form.password" :placeholder="placeholder"></b-form-input>
                </b-form-group>
                <b-button type="submit" variant="primary">提交</b-button>
            </b-form>
        </b-col>
    </b-row>
</template>

<script>
    export default {
        name: "PasswordAuth",
        data() {
            return {
                placeholder: null,
                form: {
                    password: null,
                }
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault();
                this.axios.get(window.pasteme.config.api + 'get.php?browser=&token=' +
                    this.$route.params.keyword + ',' + this.form.password).then(response => {
                    console.log(JSON.stringify(response));
                    if (response.data.status === 200) {
                        this.$parent.content = response.data.content;
                        this.$parent.type = response.data.type;
                        this.$parent.view = 'paste_view';
                    } else {
                        this.placeholder = '密码错误';
                        this.form.password = null;
                    }
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>

<style scoped>

</style>