export const lang = {
    error: {
        text: '遇到一个致命错误，请将输出的信息发送给管理员',
    },
    form: {
        input: [
            {
                prepend: '高亮',
            },
            {
                prepend: '加密',
                placeholder: '无需加密请留空',
            }
        ],
        textarea: {
            placeholder: {
                write_something_here: '写点什么进来吧',
                read_once: '一次有效，阅后即焚',
            },
        },
        select: {
            plain: '纯文本',
        },
        submit: '保存',
        checkbox: '阅后即焚',
    },
    success: {
        h2: '保存成功',
        p: [
            {
                text: '欲访问 <strong>{keyword}</strong> 所对应的 Paste',
            },
            {
                button: '返回主页',
            },
        ],
        ul: {
            li: [
                {
                    text: '在导航栏中输入<strong>索引</strong>',
                },
                {
                    browser: '在浏览器中访问',
                    tooltip: '在新页面中查看',
                },
                {
                    scan_qr_code: '扫描二维码',
                }
            ],
        },
        popover: {
            text: '在这里填入 <strong>索引</strong> 即可查看相应的 Paste',
        },
        badge: {
            copy: '复制链接',
            success: '复制成功',
            fail: '复制失败',
        }
    },
    auth: {
        form: {
            label: '此 Paste 已加密，请输入密码：',
            button: '提交',
            placeholder: '密码错误',
        }
    },
    nav: {
        router_link: '返回主页',
        form: {
            placeholder: '索引',
            button: '前往',
        },
        lang: {
            zh_CN: '简体中文',
            en: 'English',
        },
        something: {
            text: '聚合',
            log: '更新日志',
            help: 'API & 使用指南',
            feedback: '我要吐槽',
        },
        donate: '捐助',
        beg: '给个 Star 好不啦',
    },
    not_found: {
        content: {
            title: '您访问的页面没有找到',
            text: '秒后转至 PasteMe 主页',
        },
        footer: {
            text: '如果您想了解更多信息，则可以稍后在线搜索此错误：Error 404 Girlfriend Not Found',
            beg: {
                left: '在 GitHub 里给本项目一个',
                right: '吧 Orz',
            }
        }
    },
};
