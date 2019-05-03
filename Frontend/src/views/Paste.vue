<template>
    <b-row>
        <b-col md="1"></b-col>
        <b-col md="10">
            <pre id="code"><code v-bind:class="'language-' + type + ' line-numbers'">{{ content }}</code></pre>
        </b-col>
        <b-col md="1"></b-col>
    </b-row>
</template>

<script>
    import '@/../public/js/prism'
    Prism.highlightAll();
    export default {
        name: "Paste",
        data() {
            return {
                type: "",
                content: "",
            }
        },
        watch: {
            '$route' () {
                /*
                let keyword = this.$route.params.keyword;
                console.log(keyword);
                this.axios.get("http://test.cc/pasteme/api.php?token=" + keyword).then(response => {
                    document.getElementById("code").innerText = response.data;
                    this.content = response.data;
                    this.type = "cpp";
                    console.log(keyword + "finished");
                }).catch(error => {
                    console.log(error);
                });
                 */
            }
        },
        mounted() {
            let keyword = this.$route.params.keyword;
            this.axios.get("http://test.cc/pasteme/api.php?token=" + keyword).then(response => {
                this.content = response.data;
                this.type = "cpp";
            }).catch(error => {
                console.log(error);
            });
        }
    }
</script>

<style scoped>
    #code {
        font-size: .88em;
    }
</style>