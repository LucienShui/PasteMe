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
    export default {
        name: "Index",
        data() {
            return {
                view: 'home',
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
                this.disabled = false;
                if (this.$route.params.keyword === '') {
                    this.placeholder = '写点什么进来吧';
                    this.view = 'home';
                } else {
                    this.axios.get(window.pasteme.config.api + 'get.php?browser=&token=' + this.$route.params.keyword).then(response => {
                        console.log(JSON.stringify(response));
                        let code = response.data.status;
                        if (code === 200) {
                            this.view = 'paste_view';
                            this.content = response.data.content;
                            this.type = response.data.type;
                        } else if (code === 403) {
                            this.view = 'password_auth';
                        } else if (code === 404 && this.$route.params.keyword.search('[a-zA-Z]{1}') !== -1) {
                            this.disabled = true;
                            this.placeholder = '一次有效，阅后即焚';
                            this.view = 'home';
                        } else {
                            this.$router.push('What_are_nong_sha_lai');
                        }
                    }).then(function() {
                        window.Prism.highlightAll();
                    }).catch(error => {
                        console.log(error);
                    });
                }
            }
        },
        components: {
            'home': Form,
            'success': Success,
            'password_auth': PasswordAuth,
            'paste_view': PasteView,
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