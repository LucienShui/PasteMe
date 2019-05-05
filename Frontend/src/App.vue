<template>
    <b-container id="app" fluid>
        <Header />
        <transition name="router-fade" mode="out-in">
            <router-view id="fixed" />
        </transition>
        <Footer />
    </b-container>
</template>

<script>
    import Header from "./components/Header";
    import Footer from "./components/Footer";
    export default {
        components: {
            Header,
            Footer
        },
    }
</script>

<style>
    #fixed {
        margin-top: 4.5em;
    }

    .router-fade-enter-active, .router-fade-leave-active {
        transition: opacity .3s ease;
    }

    .router-fade-enter, .router-fade-leave-to {
        opacity: 0;
    }
</style>
