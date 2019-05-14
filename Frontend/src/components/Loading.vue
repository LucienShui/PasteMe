<template>
    <b-row>
        <b-col md="4"></b-col>
        <b-col md="4">
            <div class="height-fixed"></div>
            <div class="text-center">
                <b-spinner id="pasteme-spinner" variant="primary" label="Loading"></b-spinner>
            </div>
            <div class="height-fixed"></div>
        </b-col>
        <b-col md="4"></b-col>
    </b-row>
</template>

<script>
    export default {
        name: "Loading"
    }
</script>

<style scoped>
    .height-fixed {
        height: 11.9em;
    }

    #pasteme-spinner {
        width: 3em;
        height: 3em;
    }
</style>