<template>
    <b-container id="app" fluid>
        <Header />
        <router-view id="fixed" />
        <Footer />
    </b-container>
</template>

<style scoped>
    #fixed {
        margin-top: 4.5em;
    }
</style>

<script>
    import Header from "@/components/Header";
    import Footer from "@/components/Footer";
    export default {
        components: {
            Header,
            Footer
        },
    }
</script>
