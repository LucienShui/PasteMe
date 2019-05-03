<template>
    <div>
        <p>{{ result }}</p>
        <b-form @submit="onSubmit">
            <b-input v-model="form.email"></b-input>
            <b-input v-model="form.name"></b-input>
            <b-button type="submit" variant="primary">Submit</b-button>
        </b-form>
        <p v-show="home">Home</p>
        <p v-show="!home">Success</p>
        <b-button @click="home = !home">Switch</b-button>
        <b-button @click="goHome">Home</b-button>
    </div>
</template>

<script>
    export default {
        name: "Test",
        data() {
            return {
                home: false,
                form: {
                    email: '',
                    name: '',
                },
                result: 'Hello World!',
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault();
                this.axios.post('http://test.cc/test.php',
                    require('qs').stringify(this.form)).then(response => {
                    this.result = response.data['email'];
                }).catch(error => {
                    console.log(error);
                });
            },
            goHome(event) {
                event.preventDefault();
                this.$router.push({ path: '/' });
            }
        }
    }
</script>

<style scoped>

</style>