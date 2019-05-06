<template>
    <b-row>
        <b-col md="2"></b-col>
        <b-col md="8">
            <b-form @submit="onSubmit">
                <b-row>
                    <b-col md="5">
                        <b-form-group>
                            <b-input-group prepend="高亮">
                                <b-form-select v-model="form.type" :options="options"></b-form-select>
                            </b-input-group>
                        </b-form-group>
                        <b-form-group>
                            <b-input-group prepend="加密">
                                <b-form-input type="password" autocomplete="off" v-model="form.password" placeholder="无需加密请留空"></b-form-input>
                            </b-input-group>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="12">
                        <b-form-group>
                            <b-form-textarea v-model="form.content" rows="10" :placeholder="this.$parent.placeholder" required no-resize></b-form-textarea>
                        </b-form-group>
                        <b-form-group>
                            <b-checkbox-group switches>
                                <b-button type="submit" :variant="this.$parent.variant" style="margin-right: .65em">
                                    保存
                                </b-button>
                                <b-form-checkbox v-model="form.read_once" v-show="!this.$parent.disabled" switch>
                                    阅后即焚
                                </b-form-checkbox>
                            </b-checkbox-group>
                        </b-form-group>
                    </b-col>
                </b-row>
            </b-form>
        </b-col>
        <b-col md="2"></b-col>
    </b-row>
</template>

<script>
    export default {
        name: "Form",
        data() {
            return {
                form: {
                    type: 'plain',
                    password: null,
                    content: null,
                    read_once: false,
                },
                options: [
                    { text: "纯文本", value: "plain"},
                    { text: "C/C++", value: "cpp"},
                    { text: "Java", value: "java"},
                    { text: "Python", value: "python"},
                    { text: "Bash", value: "bash"},
                    { text: "HTML", value: "html"},
                    { text: "Markdown", value: "markdown"},
                ],
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault();
                if (this.$route.params.keyword !== '') {
                    this.form.keyword = this.$route.params.keyword;
                }
                this.axios.post(this.pasteme.config.api + '/set.php',
                    require('qs').stringify(this.form)).then(response => {
                    if (response.data.status === 201) {
                        this.$parent.view = 'success';
                        this.$parent.keyword = response.data.keyword;
                    }
                }).catch(error => {
                    console.log(JSON.stringify(error));
                    alert('遇到一个致命错误，请按 F12 将 console 中输出的信息发送给管理员');
                });
            },
        },
    }
</script>

<style scoped>

</style>