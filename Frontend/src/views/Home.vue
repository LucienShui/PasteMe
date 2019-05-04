<template>
    <transition name="component-fade" mode="out-in">
        <component :is="view"></component>
    </transition>
</template>

<script>
    import Form from '../components/Form'
    import Success from '../components/Success'
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
    }
</script>
