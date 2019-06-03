<template>
    <div class="row">
        <div class="col-md-12">
            <div class="footer">
                <p><a>{{ oneWord }}</a></p>
                <p>
                    <a href='http://blog.lucien.ink' target='_blank'>Lucien's Blog</a>
                    <a>&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                    <a href="http://blog.lucien.ink/go/csdn" target='_blank'>CSDN</a>
                    <a>&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                    <a href="http://www.miitbeian.gov.cn/" target='_blank'>鲁ICP备18007563号</a>
                </p>
                <p>
                    <a>&copy; 2018 - {{ year }} </a>
                    <a href='mailto:lucien@lucien.ink'>Lucien Shui</a>
                    <a> All rights reserved</a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Footer",
        data() {
            return {
                oneWord: 'Loading...',
                year: new Date().getFullYear(),
            }
        },
        mounted() {
            this.getOne().then(result => {
                this.oneWord = result;
            });
        },
        methods: {
            async getOne() {
                let one = null;
                do {
                    await this.axios.get('https://v1.hitokoto.cn?encode=text').then(response => {
                        one = response.data;
                    }).catch(error => {
                        alert(JSON.stringify(error) + '\n' + this.$t('lang.error.text'));
                    });
                } while (one.replace(/[\u4e00-\u9fa5]/ig, '**').length > 100);
                return one;
            }
        }
    }
</script>

<style scoped>
    .footer {
        font-size: .8em;
        text-align: center;
        margin-top: .8em;
    }

    .footer a:link, .footer a:visited {
        color: #38488f;
    }
</style>
