<template>
    <b-row>
        <b-col md="1"></b-col>
        <b-col md="10">
            <pre id="font-md"><code v-bind:class="'language-' + this.$parent.type + ' line-numbers'"
                       v-text="this.$parent.content"></code></pre>
        </b-col>
        <b-col md="1"></b-col>
    </b-row>
</template>

<script>
    export default {
        name: "PasteView",
        mounted() {
            this.prism.highlightAll();
        }
    }
</script>

<style scoped>
    #font-md {
        font-size: .88em;
    }
</style>
