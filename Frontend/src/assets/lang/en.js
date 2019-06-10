export const lang = {
    error: {
        text: 'A fatal error was detected. Please contact the administrator with the information',
    },
    form: {
        input: [
            {
                prepend: 'Format',
            },
            {
                prepend: 'Password',
                placeholder: 'Blank to disable encryption',
            }
        ],
        textarea: {
            placeholder: {
                write_something_here: 'Make the most of your creativity.',
                read_once: 'Burn after reading.',
            },
        },
        select: {
            plain: 'Plain',
        },
        submit: 'Submit',
        checkbox: 'Self-destruct',
    },
    success: {
        h2: 'Success!',
        p: [
            {
                text: 'How to access this Paste <strong>{keyword}</strong> :',
            },
            {
                button: 'Return',
            },
        ],
        ul: {
            li: [
                {
                    text: 'Enter <strong>Paste\'s number</strong> in the nav bar area.',
                },
                {
                    browser: 'Direct click to access: ',
                    tooltip: 'Open on a new window',
                },
                {
                    scan_qr_code: 'Scan the QR code',
                }
            ],
        },
        popover: {
            text: 'Enter <strong>Paste\'s number</strong> here to access to it.',
        },
        badge: {
            copy: 'Copy',
            success: 'Copied!',
            fail: 'Error!',
        }
    },
    auth: {
        form: {
            label: 'Please offer your password to access:',
            button: 'Submit',
            placeholder: 'Wrong password.',
        }
    },
    nav: {
        router_link: 'Homepage',
        form: {
            placeholder: 'Paste\'s number',
            button: 'Go',
        },
        lang: {
            zh_CN: '简体中文',
            en: 'English',
        },
        something: {
            text: 'Something',
            log: 'Change Logs',
            help: 'API & Guidance',
            feedback: 'Feedback',
        },
        donate: 'Donation',
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
