<template>
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
                            <b-form-input v-model="form.password" placeholder="无需加密请留空"></b-form-input>
                        </b-input-group>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col md="12">
                    <b-form-group>
                        <b-form-textarea v-model="form.content" rows="10" required no-resize></b-form-textarea>
                    </b-form-group>
                    <b-form-group>
                        <b-checkbox-group switches>
                            <b-button type="submit" variant="primary" style="margin-right: .65em">
                                保存
                            </b-button>
                            <b-form-checkbox v-model="form.read_once" switch>
                                阅后即焚
                            </b-form-checkbox>
                        </b-checkbox-group>
                    </b-form-group>
                </b-col>
            </b-row>
        </b-form>
    </b-col>
</template>

<script>
    export default {
        name: "Form",
        data() {
            return {
                placeholder: "写点什么进来吧",
                form: {
                    type: 'plain',
                    password: null,
                    content: null,
                    read_once: null,
                },
                options: [
                    { text: "纯文本", value: "plain"},
                    { text: "C/C++", value: "cpp"},
                    { text: "Java", value: "java"},
                    { text: "Python", value: "python"},
                    { text: "Bash", value: "bash"},
                    { text: "HTML", value: "html"},
                    { text: "Markdown", value: "markdown"},
                ]
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault();
                this.axios.post('http://test.cc/test.php',
                    require('qs').stringify(this.form)).then(response => {
                    alert(JSON.stringify(response.data));
                    this.$parent.view = 'pasteme_success';
                }).catch(error => {
                    console.log(error);
                });
            },
        }
    }
</script>

<style scoped>

</style>