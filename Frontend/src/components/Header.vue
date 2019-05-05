<template>
    <b-row>
        <b-col md="12">
            <b-navbar toggleable="md" variant="dark" type="dark" fixed="top">
                <router-link class="navbar-brand" to="/" title="返回主页">PasteMe</router-link>
                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
                <b-collapse id="nav-collapse" is-nav>
                    <b-nav-form @submit="onSubmit">
                        <b-input-group v-bind:prepend="host + path_name">
                            <b-form-input placeholder="索引" v-model="keyword" maxlength="8" required id="nav_input"></b-form-input>
                            <b-input-group-append>
                                <b-button type="submit" variant="primary" required="required">前往</b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-nav-form>
                    <b-navbar-nav class="ml-auto">
                        <b-nav-item-dropdown text="语言" right>
                            <b-dropdown-item href="#">EN</b-dropdown-item>
                            <b-dropdown-item href="#">ES</b-dropdown-item>
                            <b-dropdown-item href="#">RU</b-dropdown-item>
                            <b-dropdown-item href="#">FA</b-dropdown-item>
                        </b-nav-item-dropdown>
                        <b-nav-item href="https://www.lucien.ink/pasteme_log.html" target="_blank">更新日志</b-nav-item>
                        <b-nav-item href="https://github.com/LucienShui/PasteMe#帮助" target="_blank">API & 使用指南</b-nav-item>
                        <b-nav-item v-b-modal.modal-donate>捐助</b-nav-item>
                    </b-navbar-nav>
                </b-collapse>
            </b-navbar>
            <b-modal id="modal-donate" hide-footer lazy>
                <img src="../assets/donate.png" alt="donate.png">
            </b-modal>
        </b-col>
    </b-row>
</template>

<script>
    export default {
        name: "Header",
        data() {
            return {
                keyword: null,
                host: location.host,
                path_name: '/',
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault();
                this.$router.push(this.keyword);
                this.keyword = null;
            }
        }
    }
</script>

<style scoped>
    #modal-donate img {
        width: 100%;
    }
</style>