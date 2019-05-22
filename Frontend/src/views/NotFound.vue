<template>
    <b-row class="not-found-body">
        <b-col md="2"></b-col>
        <b-col md="8">
            <p class="not_found_face">:(</p>
            <p class="not_found_content">您访问的页面没有找到</p>
            <p class="not_found_content"><a class="not_found_second">{{ totalTime }}</a>&nbsp;秒后转至 PasteMe 主页</p>
            <p class="not_found_footer">如果您想了解更多信息，则可以稍后在线搜索此错误：Error 404 Girlfriend Not Found</p>
            <p class="not_found_footer">在 GitHub 里给本项目一个 <iframe src="//ghbtns.com/github-btn.html?user=LucienShui&repo=PasteMe&type=star&count=true" frameborder="0" scrolling="0" width="81px" height="20px" style="position: relative; bottom: -.25em"></iframe> 吧 Orz</p>
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
    .not_found_content {
        line-height: 1em;
        font-size: 1.5em;
    }

    .not_found_footer {
        line-height: 1em;
        font-size: 1em;
    }

    .not_found_face {
        font-size: 7em;
    }

    .not-found-body {
        color: #FFFFFF;
    }

    .not_found_second {
        font-family: TrebuchetMS,Rotobo,"Microsoft YaHei",sans-serif;
        width: 5em;
    }
</style>