<template>
    <b-container id="app" fluid :class="{ 'background_gray' : $store.state.read_once, 'background_blue' : $store.state.not_found }" style="height: 100%;">
        <Header :hidden="$store.state.not_found" />
        <transition name="router-fade" mode="out-in">
            <router-view id="fixed" />
        </transition>
        <Footer :hidden="$store.state.not_found" />
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
        mounted() {
            if (this.$cookie.get('pasteme_lang') === null) {
                this.$cookie.set('pasteme_lang', 'zh-CN', 7);
            }
            this.setI18n(this.$cookie.get('pasteme_lang'));
        }
    }
</script>

<style scoped>
    #fixed {
        padding-top: 4.5em;
    }

    .background_gray {
        background: #f0f0f0;
    }

    .background_blue {
        background: #0099CC;
    }

    .router-fade-enter-active, .router-fade-leave-active {
        transition: opacity .3s ease;
    }

    .router-fade-enter, .router-fade-leave-to {
        opacity: 0;
    }
</style>
