<template>
    <b-row class="not-found-body">
        <b-col md="2"></b-col>
        <b-col md="8">
            <p id="face">:(</p>
            <p class="content">您访问的页面没有找到。</p>
            <p class="content"><a id="second">{{ totalTime }}</a>&nbsp;秒后转至 PasteMe 主页。</p>
            <p id="footer">如果您想了解更多信息，则可以稍后在线搜索此错误：Error 404 Girlfriend Not Found</p>
        </b-col>
        <b-col md="2"></b-col>
    </b-row>
</template>

<script>
    export default {
        name: "NotFound",
        data() {
            return {
                totalTime: 5,
            }
        },
        mounted() {
            this.$store.state.not_found = true;
            let clock = window.setInterval(() => {
                this.totalTime--;
                if (this.totalTime === 0) {
                    window.clearInterval(clock);
                    this.$router.push('/');
                }
            }, 1000);
        }
    }
</script>

<style scoped>
    .content {
        line-height: 1em;
        font-size: 1.5em;
    }

    #face {
        font-size: 7em;
    }

    .not-found-body {
        color: #FFFFFF;
    }
    
    #second {
        font-family: TrebuchetMS,Rotobo,"Microsoft YaHei",sans-serif;
        width: 5em;
    }
</style>