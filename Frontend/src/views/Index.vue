<template>
    <transition name="component-fade" mode="out-in">
        <component :is="view"></component>
    </transition>
</template>

<script>
    import Form from '../components/Form'
    import Success from '../components/Success'
    import PasswordAuth from '../components/PasswordAuth'
    import PasteView from '../components/PasteView'
    import Loading from '../components/Loading'
    export default {
        name: "Index",
        data() {
            return {
                view: 'loading',
                type: null,
                content: null,
                placeholder: null,
            }
        },
        watch: {
            '$route.params.keyword': function () {
                this.init();
            }
        },
        mounted() {
            this.init();
        },
        methods: {
            init() {
                this.$store.commit('init');
                if (this.$route.params.keyword === '') {
                    this.view = 'home';
                } else {
                    this.view = 'loading';
                    this.api.get(this.$store.state.config.api, {
                        browser: '',
                        token: this.$route.params.keyword
                    }).then(response => {
                        if (response.status === 200) {
                            this.view = 'paste_view';
                            this.content = response.content;
                            this.type = response.type;
                        } else if (response.status === 403) {
                            this.view = 'password_auth';
                        } else if (response.status === 404 && this.$route.params.keyword.search('[a-zA-Z]{1}') !== -1) {
                            this.$store.commit('updateMode', {
                                read_once: true,
                            });
                            this.view = 'home';
                        } else {
                            this.$router.push('What_are_you_nong_sha_lei?');
                        }
                    });
                }
            },
        },
        components: {
            'home': Form,
            'success': Success,
            'password_auth': PasswordAuth,
            'paste_view': PasteView,
            'loading': Loading,
        }
    }
</script>

<style scoped>
    .component-fade-enter-active, .component-fade-leave-active {
        transition: opacity .6s ease;
    }

    .component-fade-enter, .component-fade-leave-to {
        opacity: 0;
    }
</style>
