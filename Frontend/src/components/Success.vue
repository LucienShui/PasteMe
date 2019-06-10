<template>
    <b-row>
        <b-col md="2"></b-col>
        <b-col md="8" id="success_fixed">
            <div class="jumbotron">
                <h2>
                    {{ $t('lang.success.h2') }}
                </h2>
                <p v-html="$t('lang.success.p[0].text', { keyword: $parent.keyword })"></p>
                <ul>
                    <li><a v-html="$t('lang.success.ul.li[0].text')"></a>&nbsp;<b-badge
                            pill class="badge-fixed"
                            href="#"
                            @mouseenter="popover_show = true"
                            @mouseleave="popover_show = false">?</b-badge>
                    </li>
                    <li>{{ $t('lang.success.ul.li[1].browser') }}
                        <a
                                v-b-tooltip.hover="$t('lang.success.ul.li[1].tooltip')"
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
                            {{ $t('lang.success.badge.' +
                            (copy_btn_status > 0 ? 'success' : (copy_btn_status === 0 ?  'copy' : 'fail')))  }}
                        </b-badge>
                    </li>
                    <li>
                        <b-link id="qr_code_link">{{ $t('lang.success.ul.li[2].scan_qr_code') }}</b-link>
                    </li>
                </ul>
                <p>
                    <b-button @click="goHome" variant="primary">{{ $t('lang.success.p[1].button') }}</b-button>
                </p>
            </div>
        </b-col>
        <b-col md="2"></b-col>
        <b-popover
                :show.sync="popover_show"
                target="nav_input"
                placement="bottomright"
        ><a v-html="$t('lang.success.popover.text')"></a></b-popover>
        <b-popover
                target="qr_code_link"
                placement="auto"
                triggers="hover"
        >
            <div class="text-center">
                <QRCode :value="this.base_url + this.$parent.keyword" :options="{ width: 168 }"></QRCode>
            </div>
        </b-popover>
    </b-row>
</template>

<script>
    export default {
        name: "Success",
        data() {
            return {
                base_url: this.$store.state.config.protocol + this.$store.state.config.base_url,
                clipboard_object: null,
                copy_btn_status: 0,
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
                    cur.copy_btn_status = 1;
                    window.setTimeout(function () {
                        cur.copy_btn_status = 0;
                    }, 2000);
                });
                clipboard.on('error', function() {
                    cur.copy_btn_status = -1;
                    window.setTimeout(function () {
                        cur.copy_btn_status = 0;
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
