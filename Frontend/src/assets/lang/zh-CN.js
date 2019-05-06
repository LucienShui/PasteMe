export const lang = {
    error: {
        text: '遇到一个致命错误，请按 F12 将 console 中输出的信息发送给管理员',
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
                left: '欲访问',
                right: '所对应的 Paste',
            },
            {
                button: '返回主页',
            },
        ],
        ul: {
            li: [
                {
                    left: '在导航栏中输入',
                    mid: '索引',
                    right: '',
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
            left: '在这里填入',
            mid: '索引',
            right: '即可查看相应的 Paste',
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
        dropdown: {
            zh_CN: '简体中文',
            en: 'English',
        },
        log: '更新日志',
        help: 'API & 使用指南',
        donate: '捐助',
    }
};