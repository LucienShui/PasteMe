<template>
    <b-row>
        <b-col md="2"></b-col>
        <b-col md="8" id="success-fixed">
            <div class="jumbotron">
                <h2>
                    保存成功
                </h2>
                <p>
                    欲访问 <b id="success_jumbotron_p_b">{{ this.$parent.keyword }}</b> 所对应的 Paste：
                </p>
                <ul>
                    <li>在导航栏中输入索引</li>
                    <li>在浏览器中访问：<router-link :to="this.$parent.keyword">{{ this.base_url + this.$parent.keyword }}</router-link>&nbsp;<a tabindex="1" id="copy" href="#">复制链接</a></li>
                    <li><a id="success_qrcode_link" v-bind:href="this.base_url + this.$parent.keyword + '&tag=PasteMe - 可能是最low的文本分享平台'" target="_blank">扫描二维码</a></li>
                </ul>
                <p>
                    <b-button @click="onHome" variant="primary">返回主页</b-button>
                </p>
            </div>
        </b-col>
        <b-col md="2"></b-col>
    </b-row>
</template>

<script>
    export default {
        name: "Success",
        data() {
            return {
                base_url: 'http://localhost:8080/',
            }
        },
        methods: {
            onHome(event) {
                event.preventDefault();
                this.$parent.view = 'pasteme_form';
            }
        }
    }
</script>

<style scoped>
    #success-fixed {
        margin-top: 1.375em;
        margin-bottom: 1.375em;
    }
</style>