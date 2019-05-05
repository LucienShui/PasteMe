<template>
    <b-row>
        <b-col md="2"></b-col>
        <b-col md="8" id="success_fixed">
            <div class="jumbotron">
                <h2>
                    保存成功
                </h2>
                <p>
                    欲访问 <b id="success_jumbotron_p_b">{{ $parent.keyword }}</b> 所对应的 Paste：
                </p>
                <ul>
                    <li>在导航栏中输入<strong>索引</strong>&nbsp;<b-badge pill class="badge-fixed" href="#" @click="popover_show = !popover_show">?</b-badge></li>
                    <li>在浏览器中访问：
                        <a
                                v-b-tooltip.hover="'在新页面中查看'"
                                :href="base_url + $parent.keyword"
                                target="_blank"
                        >
                            {{ base_url + $parent.keyword }}
                        </a>&nbsp;<b-badge
                                variant="info"
                                id="copy_btn"
                                class="badge-fixed"
                                :data-clipboard-text="base_url + $parent.keyword"
                                @click="onCopy"
                                href="#"
                        >
                            {{ copy_btn_text }}
                        </b-badge>
                    </li>
                    <li>
                        <b-link v-b-modal.modal_qr_code>扫描二维码
                        </b-link>
                    </li>
                </ul>
                <p>
                    <b-button @click="goHome" variant="primary">返回主页</b-button>
                </p>
            </div>
        </b-col>
        <b-col md="2"></b-col>
        <b-popover
                :show.sync="popover_show"
                target="nav_input"
                placement="bottomright"
                triggers="hover"
        >
            在这里填入<strong>索引</strong>即可查看相应的 Paste
        </b-popover>
        <b-modal id="modal_qr_code" size="sm" hide-footer lazy style="text-align: center;">
            <qrcode :value="this.base_url + this.$parent.keyword" :options="{ width: 200 }"></qrcode>
            <p>PasteMe - 一个不算糟糕的可私有文本分享平台</p>
        </b-modal>
    </b-row>
</template>

<script>
    export default {
        name: "Success",
        data() {
            return {
                base_url: window.pasteme.config.protocol + window.pasteme.config.base_url,
                clipboard_object: null,
                copy_btn_text: '复制链接',
                popover_show: false,
            }
        },
        mounted() {
            this.clipboard_object = new this.clipboard('#copy_btn');
        },
        methods: {
            goHome(event) {
                event.preventDefault();
                if (this.$route.params.keyword !== '') {
                    this.$router.push('/');
                } else {
                    this.$parent.view = 'home';
                }
            },
            onCopy() {
                let clipboard = this.clipboard_object;
                let cur = this;
                clipboard.on('success', function() {
                    cur.copy_btn_text = '复制成功';
                    window.setTimeout(function () {
                        cur.copy_btn_text = '复制链接'
                    }, 2000);
                });
                clipboard.on('error', function() {
                    cur.copy_btn_text = '复制失败';
                    window.setTimeout(function () {
                        cur.copy_btn_text = '复制链接'
                    }, 2000);
                });
            }
        }
    }
</script>

<style scoped>
    #success_fixed {
        margin-top: 1.375em;
        margin-bottom: 1.375em;
    }

    .badge-fixed {
        position: relative;
        bottom: .2em;
    }
</style>