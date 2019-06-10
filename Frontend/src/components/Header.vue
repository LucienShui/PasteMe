<template>
    <b-row>
        <b-col md="12">
            <b-navbar toggleable="md" variant="dark" type="dark" fixed="top">
                <router-link class="navbar-brand" to="/" :title="$t('lang.nav.router_link')">PasteMe</router-link>
                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
                <b-collapse id="nav-collapse" is-nav>
                    <b-nav-form @submit="onSubmit">
                        <b-input-group v-bind:prepend="this.$store.state.config.base_url">
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
                                {{ $t('lang.nav.lang.zh_CN') }}
                            </b-dropdown-item>
                            <b-dropdown-item href="#" @click="setLang('en')">
                                {{ $t('lang.nav.lang.en') }}
                            </b-dropdown-item>
                        </b-nav-item-dropdown>
                        <b-nav-item-dropdown right>
                            <template slot="button-content">
                                {{ $t('lang.nav.something.text') }}
                            </template>
                            <b-dropdown-item href="https://blog.lucien.ink/pasteme_log.html" target="_blank">
                                {{ $t('lang.nav.something.log') }}
                            </b-dropdown-item>
                            <b-dropdown-item href="https://github.com/LucienShui/PasteMe/blob/master/DOCUMENT.md" target="_blank">
                                {{ $t('lang.nav.something.help') }}
                            </b-dropdown-item>
                            <b-dropdown-item href="https://github.com/LucienShui/PasteMe/issues" target="_blank">
                                {{ $t('lang.nav.something.feedback') }}
                            </b-dropdown-item>
                        </b-nav-item-dropdown>
                        <b-nav-item v-b-modal.modal-donate>{{ $t('lang.nav.donate') }}</b-nav-item>
                    </b-navbar-nav>
                </b-collapse>
                <a href="https://github.com/LucienShui/PasteMe"
                   target="_blank" class="github-corner ml-show"
                   aria-label="View source on GitHub">
                    <svg width="80" height="80" viewBox="0 0 250 250"
                         style="fill:#151513; color:#fff; position: absolute; top: 3.5em; border: 0; right: 0;"
                         id="github-icon"
                         aria-hidden="true">
                        <path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path>
                        <path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2"
                              fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path>
                        <path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path>
                    </svg>
                </a>
            </b-navbar>
            <b-popover
                    target="github-icon"
                    placement="auto"
                    triggers="hover"
            >
                <div class="text-center">
                    {{ $t('lang.nav.beg') }}
                </div>
            </b-popover>
            <b-modal id="modal-donate" hide-footer lazy>
                <img src="../assets/img/donate.png" alt="donate.png">
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
                this.setI18n(lang);
                this.$cookie.set('pasteme_lang', lang, 7);
            }
        }
    }
</script>

<style scoped>
    #modal-donate img {
        width: 100%;
    }

    @media screen and (max-width: 767px) {
        .ml-show {
            display: none;
        }
    }
</style>
