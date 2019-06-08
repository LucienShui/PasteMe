<template>
    <b-row>
        <b-col md="1" lg="2"></b-col>
        <b-col md="10" lg="8">
            <b-form @submit="onSubmit">
                <b-row>
                    <b-col md="7" lg="5">
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
                                             ($store.state.read_once ? 'read_once' : 'write_something_here'))"
                                             required no-resize></b-form-textarea>
                        </b-form-group>
                        <b-form-group>
                            <b-checkbox-group switches>
                                <b-button type="submit" :variant="$store.state.read_once ? 'dark' : 'primary'" style="margin-right: .65em">
                                    {{ $t('lang.form.submit') }}
                                </b-button>
                                <b-form-checkbox v-model="form.read_once" v-show="!$store.state.read_once" switch>
                                    {{ $t('lang.form.checkbox') }}
                                </b-form-checkbox>
                            </b-checkbox-group>
                        </b-form-group>
                    </b-col>
                </b-row>
            </b-form>
        </b-col>
        <b-col md="1" lg="2"></b-col>
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
                    read_once: []
                }
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault();
                if (this.$route.params.keyword !== '') {
                    this.form.keyword = this.$route.params.keyword;
                }
                this.api.post(this.$store.state.config.api, this.form).then(response => {
                    if (response.status === 201) {
                        this.$parent.view = 'success';
                        this.$parent.keyword = response.keyword;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
