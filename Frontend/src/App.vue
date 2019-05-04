<template>
    <b-container id="app" fluid>
        <Header />
        <transition name="component-fade" mode="out-in">
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

    .component-fade-enter-active, .component-fade-leave-active {
        transition: opacity .3s ease;
    }

    .component-fade-enter, .component-fade-leave-to {
        opacity: 0;
    }
</style>
