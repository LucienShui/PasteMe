<template>
    <div class="row">
        <div class="col-md-12">
            <div class="footer">
                <p><a>{{ oneWord }}</a></p>
                <p>
                    <a href='http://www.lucien.ink' target='_blank'>Lucien's Blog</a>
                    <a>&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                    <a href="http://www.lucien.ink/go/csdn" target='_blank'>CSDN</a>
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
                oneWord: null,
                year: new Date().getFullYear(),
            }
        },
        mounted() {
            this.axios.get('https://v1.hitokoto.cn?encode=text').then(response => {
                this.oneWord = response.data;
            }).catch(error => {
                console.log(JSON.stringify(error));
                alert('遇到一个致命错误，请按 F12 将 console 中输出的信息发送给管理员');
            });
        },
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