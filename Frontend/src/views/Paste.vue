<template>
    <transition name="component-fade" mode="out-in">
        <component v-bind:is="view"></component>
    </transition>
</template>

<script>
    import PasswordAuth from '../components/PasswordAuth'
    import PasteView from '../components/PasteView'

    export default {
        name: "Paste",
        data() {
            return {
                keyword: this.$route.params.keyword,
                view: null,
                content: null,
                type: 'cpp',
            }
        },
        watch: {
            '$route': function () {
                this.init();
            }
        },
        mounted() {
            this.init();
        },
        components: {
            'pasteme_paste_view': PasteView,
            'pasteme_password_auth': PasswordAuth,
        },
        methods: {
            init() {
                this.axios.get(window.pasteme.config.api + 'get.php?browser=&token=' + this.keyword).then(response => {
                    console.log(JSON.stringify(response));
                    let code = response.data.status;
                    if (code === 200) {
                        this.view = 'pasteme_paste_view';
                        this.content = response.data.content;
                        this.type = response.data.type;
                    } else if (code === 403) {
                        this.view = 'pasteme_password_auth';
                    } else {
                        location.pathname = 'What_are_you_doing';
                    }
                }).then(function() {
                    window.Prism.highlightAll();
                }).catch(error => {
                    console.log(error);
                });
            },
        },
    }
</script>

<style scoped>
    pre {
        font-size: .88em;
    }
</style>