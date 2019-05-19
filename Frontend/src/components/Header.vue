<template>
    <b-row>
        <b-col md="12">
            <b-navbar toggleable="md" variant="dark" type="dark" fixed="top">
                <router-link class="navbar-brand" to="/" :title="$t('lang.nav.router_link')">PasteMe</router-link>
                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
                <b-collapse id="nav-collapse" is-nav>
                    <b-nav-form @submit="onSubmit">
                        <b-input-group v-bind:prepend="this.pasteme.config.base_url">
                            <b-form-input :placeholder="$t('lang.nav.form.placeholder')" v-model="keyword" maxlength="8"
                                    autocomplete="off" required id="nav_input"></b-form-input>
                            <b-input-group-append>
                                <b-button type="submit" variant="primary"
                                          required="required">{{ $t('lang.nav.form.button') }}</b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-nav-form>
                    <b-navbar-nav class="ml-auto">
                        <b-nav-item-dropdown right>
                            <template slot="button-content">
                                <font-awesome-icon icon="globe-asia" />
                            </template>
                            <b-dropdown-item href="#" @click="setLang('zh-CN')">
                                {{ $t('lang.nav.dropdown.zh_CN') }}
                            </b-dropdown-item>
                            <b-dropdown-item href="#" @click="setLang('en')">
                                {{ $t('lang.nav.dropdown.en') }}
                            </b-dropdown-item>
                        </b-nav-item-dropdown>
                        <b-nav-item href="https://www.lucien.ink/pasteme_log.html" target="_blank">
                            {{ $t('lang.nav.log') }}
                        </b-nav-item>
                        <b-nav-item href="https://github.com/LucienShui/PasteMe#帮助" target="_blank">
                            {{ $t('lang.nav.help') }}
                        </b-nav-item>
                        <b-nav-item v-b-modal.modal-donate>{{ $t('lang.nav.donate') }}</b-nav-item>
                    </b-navbar-nav>
                </b-collapse>
            </b-navbar>
            <b-modal id="modal-donate" hide-footer>
                <img src="../assets/donate.png" alt="donate.png">
            </b-modal>
        </b-col>
    </b-row>
</template>

<script>
    export default {
        name: "Header",
        data() {
            return {
                keyword: null,
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault();
                this.$router.push(this.keyword);
                this.keyword = null;
            },
            setLang(lang) {
                this.$i18n.locale = lang;
                this.$cookie.set('pasteme_lang', lang, 7);
            }
        }
    }
</script>

<style scoped>
    #modal-donate img {
        width: 100%;
    }
</style>