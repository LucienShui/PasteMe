<template>
    <b-row>
        <b-col md="2"></b-col>
        <b-col md="8">
            <b-form @submit="onSubmit">
                <b-row>
                    <b-col md="5">
                        <b-form-group>
                            <b-input-group :prepend="$t('lang.form.input[0].prepend')">
                                <b-form-select v-model="form.type">
                                    <option value="plain">{{ this.$t('lang.form.select.plain') }}</option>
                                    <option value="cpp">C/C++</option>
                                    <option value="java">Java</option>
                                    <option value="python">Python</option>
                                    <option value="bash">Bash</option>
                                    <option value="markdown">Markdown</option>
                                    <option value="html">HTML</option>
                                </b-form-select>
                            </b-input-group>
                        </b-form-group>
                        <b-form-group>
                            <b-input-group :prepend="$t('lang.form.input[1].prepend')">
                                <b-form-input type="password" autocomplete="off" v-model="form.password"
                                              :placeholder="$t('lang.form.input[1].placeholder')"></b-form-input>
                            </b-input-group>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="12">
                        <b-form-group>
                            <b-form-textarea v-model="form.content" rows="10"
                                             :placeholder="$t('lang.form.textarea.placeholder.' +
                                             (this.$parent.disabled ? 'read_once' : 'write_something_here'))"
                                             required no-resize></b-form-textarea>
                        </b-form-group>
                        <b-form-group>
                            <b-checkbox-group switches>
                                <b-button type="submit" :variant="this.$parent.variant" style="margin-right: .65em">
                                    {{ $t('lang.form.submit') }}
                                </b-button>
                                <b-form-checkbox v-model="form.read_once" v-show="!this.$parent.disabled" switch>
                                    {{ $t('lang.form.checkbox') }}
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
                    alert(this.$t('lang.error.text'));
                });
            },
        },
    }
</script>

<style scoped>

</style>