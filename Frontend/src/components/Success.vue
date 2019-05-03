<template>
    <b-col md="8" id="fixed">
        <div class="jumbotron">
            <h2>
                保存成功
            </h2>
            <p>
                欲访问 <b id="success_jumbotron_p_b">{{ keyword }}</b> 所对应的 Paste：
            </p>
            <ul>
                <li>在主页中输入索引</li>
                <li>在浏览器中访问：<a id="url">{{ keyword }}</a> <a tabindex="1" id="copy" href="#">复制链接</a></li>
                <li><a id="success_qrcode_link" v-bind:href="base_url + keyword + '&tag=PasteMe - 可能是最low的文本分享平台'" target="_blank">扫描二维码</a></li>
            </ul>
            <p>
                <b-button @click="onHome" variant="primary">返回主页</b-button>
            </p>
        </div>
    </b-col>
</template>

<script>
    export default {
        name: "Success",
        data() {
            return {
                keyword: null,
                base_url: null,
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
    #fixed {
        margin-top: 1.375em;
        margin-bottom: 1.375em;
    }
</style>