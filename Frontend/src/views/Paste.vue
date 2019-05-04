<template>
    <b-row>
        <b-col md="1"></b-col>
        <b-col md="10">
            <pre><code v-bind:class="'language-' + type + ' line-numbers'" v-text="content"></code></pre>
        </b-col>
        <b-col md="1"></b-col>
    </b-row>
</template>

<script>
    export default {
        name: "Paste",
        data() {
            return {
                content: null,
                type: 'cpp',
            }
        },
        watch: {
            '$route': function () {
                this.request();
            }
        },
        methods: {
            request() {
                let keyword = this.$route.params.keyword;
                this.axios.get("http://test.cc/pasteme/api.php?vue=&token=" + keyword).then(response => {
                    console.log(JSON.stringify(response));
                    this.content = response.data.content;
                    this.type = response.data.type;
                }).then(function() {
                    window.Prism.highlightAll();
                }).catch(error => {
                    console.log(error);
                });
            },
        },
        mounted() {
            this.request();
        },
    }
</script>

<style scoped>
    pre {
        font-size: .88em;
    }
</style>