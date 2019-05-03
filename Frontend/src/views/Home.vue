<template>
    <b-row>
        <b-col md="2"></b-col>
        <transition name="component-fade" mode="out-in">
            <component v-bind:is="view"></component>
        </transition>
        <b-col md="2"></b-col>
    </b-row>
</template>

<style scoped>
    #blank {
        height: 4.5em;
    }
    .component-fade-enter-active, .component-fade-leave-active {
        transition: opacity .3s ease;
    }
    .component-fade-enter, .component-fade-leave-to {
        opacity: 0;
    }
</style>

<script>
    import Form from '@/components/Form.vue'
    import Success from '@/components/Success.vue'
    export default {
        name: 'home',
        data() {
            return {
                view: 'pasteme_form',
            }
        },
        components: {
            'pasteme_form': Form,
            'pasteme_success': Success,
        },
        methods: {
            onReset(event) {
                event.preventDefault();
            }
        }
    }
</script>
